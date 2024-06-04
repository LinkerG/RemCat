<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\CalcSeason;
use DateTime;
use Carbon\Carbon;
use MongoDB\BSON\ObjectID;
use Barryvdh\DomPDF\Facade\Pdf;

class CompetitionController extends Controller
{
    //------------------CRUD------------------//
    public function showAddForm(){
        return view('admin/addSponsors');
    }

    public function store(Request $request){
        $dateStr = $request->input("competition-date");
        $dateTime = DateTime::createFromFormat('Y-m-d', $dateStr);
        $date = Carbon::parse($dateTime)->toDateString();

        $year = CalcSeason::calculate();
        $seasonName = $year . "_competitions";

        $error = [];
        $parameters = [
            "name" => $request->input("name"),
            "boatType" => $request->input("boatType"),
            "date" => $date,
        ];
        if (!Competition::checkIfExists($seasonName, $parameters)) {
            Competition::storeCompetition($year, $request);
            echo "a";
        } else{
            echo "b";
        }

        //return redirect()->route('admin.competitions.add', ['lang' => app()->getLocale()])->withErrors(implode(', ', $error));
    }


    public function viewAll($year){
        $competitions = Competition::getAllCompetitions($year, $dateRestriction = false, $onlyActives = false);
        $years = [];

        $mongoCollections = DB::connection('mongodb')->listCollections();

        foreach ($mongoCollections as $collection) {
            if (preg_match("/^\d{2}_\d{2}_competitions$/", $collection->getName())) {
                $collectionName = $collection->getName();
                $years[] = strstr($collectionName, '_competitions', true);
            }
        }


        return view("admin/viewCompetitions", compact("competitions", "year", "years"));
    }

    public function showEditForm($year, $_id) {
        $competition = Competition::getCompetitionById($year, $_id);

        return view("admin/editCompetitions", ['competition' => $competition]);
    }

    public function update(Request $request, $year, $_id) {
        $dateStr = $request->input("competition-date");
        $dateNotFormatted = DateTime::createFromFormat('Y-m-d', $dateStr);
        $date = $dateNotFormatted->format('d-m-Y');

        $updatedData = [
            'name' => $request->input('name'),
            'location' => $request->input('location'),
            'boatType' => $request->input('boatType'),
            'isOpen' => $request->has("isOpen") ? true : false,
            'date' => $date,
            'sponsor_price' => $request->input('price'),
            'sponsors_list' => $request->input('sponsors-list'),
        ];

        $succes = Competition::updateCompetition($year, $_id, $updatedData) ? true : false;

        return redirect()->route('admin.competitions', ['lang' => app()->getLocale()])->with('succes', $succes);
    }

    public function joinCompetition(Request $request){
        $route = request()->path();
        $routeArray = explode('/', $route);

        $year = CalcSeason::calculate();

        $competition_id = $routeArray[4];
        $category = $request->input("category1") . $request->input("category2");

        $collectionName = $year . "_competitions_results";

        $parameters = [
            "competition_id" => $competition_id,
            "category" => $category,
            "teamName" => $request->input("teamName"),
        ];
        if (!Competition::checkIfExists($collectionName, $parameters)) {
            Competition::joinCompetition($year, $request, $competition_id);
        } else{
        }

        return redirect()->route('home');
    }

    public function changeIsActive(Request $request){
        $_id = $request->input("_id");
        $year = $request->input("year");

        $newStatus = $request->input("newStatus");
        if($newStatus === "true") $newStatus = true;
        else $newStatus = false;

        $updatedData = [
            'isActive' => $newStatus
        ];

        $succes = Competition::updateCompetition($year, $_id, $updatedData) ? true : false;

        return response()->json(['changed' => $succes]);
    }

    public function changeIsCancelled(Request $request){
        $_id = $request->input("_id");
        $year = $request->input("year");
        $newStatus = $request->input("newStatus");
        if($newStatus === "true") $newStatus = true;
        else $newStatus = false;

        $updatedData = [
            'isCancelled' => $newStatus
        ];

        $succes = Competition::updateCompetition($year, $_id, $updatedData) ? true : false;

        return response()->json(['changed' => $succes]);
    }

    public function uploadCompetitionImages($request, $_id, $year){
        ImageController::multipleUpload($request, $_id, $year);


    }

    public function validateTime($result_id){
        Competition::validateTime($result_id);

        echo "Tiempo validado correctamente";
    }

    //------------------CRUD-END------------------//

    //------------------VIEW-CALLS------------------//
    // Pagina principal
    public function showFrontPage($year) {
        $competitions = Competition::getAllCompetitions($year, $take = 4);
        $sponsors = Sponsor::where("isActive", true)->get();

        return view("frontPage", compact("competitions", "sponsors", "year"));
    }

    // Apuntarse a competicion
    public function showJoinForm($year, $_id, $insurances) {
        $competition = Competition::getCompetitionById($year, $_id);
        if(session('userAuth')) {
            return view("competitions/joinCompetitionSingleTeam", compact("competition", "year", "insurances"));
        } elseif(session('teamAuth')) {
            return view("competitions/joinCompetitionMultipleTeam", compact("competition", "year"));
        }
        return view("competitions/joinCompetitionSingleTeam", compact("competition", "year", "insurances"));
    }
    public function showJoinFormMultiple($year, $_id) {
        $competition = Competition::getCompetitionById($year, $_id);

        return view("competitions/joinCompetitionMultipleTeam", compact("competition", "year"));
    }

    // Ver todas las competiciones de un año
    public function showAllCompetitions($year) {
        $competitions = Competition::getAllCompetitions($year, false);

        return view("competitions/viewCompetitions", compact("competitions", "year"));
    }

    public function showAdminCompetitionInfo($year, $_id){
        $competition = Competition::getCompetitionById($year, $_id);

        return view("admin/competitionInfo", compact("competition", "year"));
    }
    public function showAdminImagesDragAndDrop($year,$_id) {
        $competition = Competition::getCompetitionById($year,$_id);

        return view('admin/addCompetitionsImages', compact('competition', 'year'));
    }
    public function showCompetitionInfo($year, $_id) {
        $competition = Competition::getCompetitionById($year, $_id);
        $sponsors = json_decode($competition->sponsors_list);
        return view("competitions/competitionInfo", compact("competition", "year", "sponsors"));
    }

    public function showCompetitionResult($year, $_id) {
        $competition = Competition::getCompetitionById($year, $_id);
        $results = Competition::getCompetitionResult($year, $_id);

        return view("competitions/results", compact("competition", "results", "year"));
    }
    
    public function competitionPdf($year, $_id) {
        $competition = Competition::getCompetitionById($year, $_id);
        $results = Competition::getCompetitionResult($year, $_id);
    
        $resultsOrdenados = json_decode($results, true);
    
        // Inicializar array de categorías
        $categories = [
            'Alevin' => ['Masculino' => [], 'Femenino' => []],
            'Infantil' => ['Masculino' => [], 'Femenino' => []],
            'Cadete' => ['Masculino' => [], 'Femenino' => []],
            'Juvenil' => ['Masculino' => [], 'Femenino' => []],
            'Sénior' => ['Masculino' => [], 'Femenino' => []],
            'Veterano' => ['Masculino' => [], 'Femenino' => []],
        ];
    
        // Asignar nombres a las categorías
        $category_names = [
            'A' => 'Alevin',
            'I' => 'Infantil',
            'C' => 'Cadete',
            'J' => 'Juvenil',
            'S' => 'Sénior',
            'V' => 'Veterano',
        ];
    
        // Función para convertir tiempo de mm:ss:ms a milisegundos
        function timeToMilliseconds($time) {
            list($minutes, $seconds, $milliseconds) = explode(':', $time);
            return ($minutes * 60 * 1000) + ($seconds * 1000) + $milliseconds;
        }
    
        // Recorrer datos y organizar por categoría
        foreach ($resultsOrdenados as $item) {
            if (!isset($item['category'])) continue;
            $category = $item['category'];
            $gender = $category[1] == 'M' ? 'Masculino' : 'Femenino';
            $category_key = $category[0];
    
            if (isset($category_names[$category_key])) {
                $category_name = $category_names[$category_key];
                $time = $item['time'] ?? 'DNS';
                if ($time === 'DNS') {
                    $time = 'Descalificado';
                }
                $categories[$category_name][$gender][] = ['teamName' => $item['teamName'], 'time' => $time];
            }
        }
    
        // Ordenar los equipos por tiempo en cada categoría y género
        foreach ($categories as $category => $genders) {
            foreach ($genders as $gender => &$teams) {
                usort($teams, function ($a, $b) {
                    if ($a['time'] === 'Descalificado' && $b['time'] === 'Descalificado') {
                        return 0;
                    } elseif ($a['time'] === 'Descalificado') {
                        return 1;
                    } elseif ($b['time'] === 'Descalificado') {
                        return -1;
                    } else {
                        $timeA = timeToMilliseconds($a['time']);
                        $timeB = timeToMilliseconds($b['time']);
                        return $timeA - $timeB;
                    }
                });
            }
        }
    
        $pdf = Pdf::loadView('admin/competitionPdf', compact('competition', 'results', 'year', 'categories'));
        return $pdf->stream();
        // return $pdf->download('competition.pdf');
    }
    //------------------VIEW-CALLS-END------------------//

    //------------------ENDPOINTS------------------//
    public function fetchYears(){
        $collections = [];

        $mongoCollections = DB::connection('mongodb')->listCollections();

        foreach ($mongoCollections as $collection) {
            if (preg_match("/^\d{2}_\d{2}_competitions$/", $collection->getName())) {
                $collections[] = $collection->getName();
            }
        }

        return response()->json($collections);

    }

    public function joinCompetitionApi(Request $request){
        $year = CalcSeason::calculate();
        $collectionName = $year . "_competitions_results";
        $_id = $request->input("_id") ? $request->input("_id") : new ObjectID();
        $competition_id = $request->input("competition_id");
        $category = $request->input("category1") . $request->input("category2");

        $ok = false;
        $parameters = [
            "competition_id" => $competition_id,
            "category" => $category,
            "teamName" => $request->input("teamName"),
        ];
        if (!Competition::checkIfExists($collectionName, $parameters)) {
            $ok = Competition::joinCompetition($year, $request, $competition_id);
        } else{}
        $response = [
            "ok" => $ok,
            "_id" => $_id,
            "edit" => false
        ];

        return response()->json($response);
    }

    function getCompetitionsFromTeam(Request $request){
        $year = CalcSeason::calculate();

        $competitions = Competition::getCompetitionsByTeam($year, $request);

        return response()->json($competitions);
    }

    function getResultsFromCompetition(Request $request){
        $results = Competition::getResultsFromCompetition($request);

        return response()->json($results);
    }

    public function setTimes(Request $request) {
        // Decodificar el JSON de timesToUpdate
        $times = json_decode($request->input('timesToUpdate'), true);
        $year = $request->input('year');
        $competition_id = $request->input('competition_id');

        Competition::setTimesForCompetition($year, $competition_id, $times);

        $response = ["ok" => "ok"];

        return response()->json($response);
    }

    //------------------ENDPOINTS-END------------------//

}
