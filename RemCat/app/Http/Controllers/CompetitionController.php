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
            $error[]="succes";
            Competition::storeCompetition($year, $request);
        } else{
            $error[]="exists";
        }
        
        return redirect()->route('admin.competitions.add', ['lang' => app()->getLocale()])->withErrors(implode(', ', $error));
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
        if (Competition::checkIfExists($collectionName, $parameters)) {
            Competition::joinCompetition($year, $request, $competition_id);
        } else{}
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

    //------------------CRUD-END------------------//

    //------------------VIEW-CALLS------------------//
    // Pagina principal
    public function showFrontPage($year) {
        $competitions = Competition::getAllCompetitions($year, $take = 4);
        $sponsors = Sponsor::where("isActive", true)->get();

        return view("frontPage", compact("competitions", "sponsors", "year"));
    }

    // Apuntarse a competicion
    public function showJoinForm($year, $_id) {
        $competition = Competition::getCompetitionById($year, $_id);
        
        return view("competitions/joinCompetitionSingleTeam", compact("competition", "year"));
    }
    public function showJoinFormMultiple($year, $_id) {
        $competition = Competition::getCompetitionById($year, $_id);
        
        return view("competitions/joinCompetitionMultipleTeam", compact("competition", "year"));
    }

    // Ver todas las competiciones de un año
    public function showAllCompetitions($year) {
        $competitions = Competition::getAllCompetitions($year);

        return view("competitions/viewCompetitions", compact("competitions", "year"));
    }

    public function showAdminCompetitionInfo($year, $_id){
        $competition = Competition::getCompetitionById($year, $_id);
        
        return view("admin/competitionInfo", compact("competition", "year"));
    }

    public function showCompetitionInfo($year, $_id) {
        $competition = Competition::getCompetitionById($year, $_id);
        
        return view("competitions/competitionInfo", compact("competition", "year"));
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

    //------------------ENDPOINTS-END------------------//

}
