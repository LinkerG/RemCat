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
        $name = $request->input('name');
        $location = $request->input("address");
        $boatType = $request->input("boatType");
        $isOpen = $request->has("isOpen") ? true : false;
        
        // Se modifica la creación del objeto DateTime para el formato correcto
        $dateStr = $request->input("competition-date");
        $date = DateTime::createFromFormat('Y-m-d', $dateStr);
        $dateMongo = Carbon::parse($date)->toDateString();
    
        $price = $request->input("price");
        $sponsorsList = $request->input("sponsors-list");
        
        $seasonName = CalcSeason::calculate() . "_competitions";
        
        $error = [];
        if (!$competitionComparator = (
            new Competition())
            ->setCollection($seasonName)
            ->where("name", $name)
            ->where("boatType", $boatType)
            ->where("date", $dateMongo)
            ->exists()
        ) {
            $competition = new Competition;
            $competition->setCollection($seasonName);
            $_id = new ObjectID();
            $mapImage = ImageController::storeImage(request(), "competition-maps", "image-map" ,$_id);
            $bannerImage = ImageController::storeImage(request(), "competition-banners", "image-banner" ,$_id);
            $competition->name = $name;
            $competition->location = $location;
            $competition->boatType = $boatType;
            $competition->isOpen = $isOpen;
            $competition->date = $dateMongo;
            $competition->sponsor_price = $price;
            $competition->sponsors_list = $sponsorsList;
            $competition->image_map = $mapImage;
            $competition->image_banner = $bannerImage;
            $competition->isCancelled = false;
            $competition->isActive = true;
            $competition->save();
        } else{

        }
        
        // Para redirigir con el idioma hay que hacerlo asi
        return redirect()->route('admin.competitions.add', ['lang' => app()->getLocale()])->withErrors(implode(', ', $error));
    }
    

    public function viewAll($year){
        $seasonName = $year . "_competitions";
        $competitions = (new Competition())->setCollection($seasonName)->get();
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
        $seasonName = $year . "_competitions";
        $competition = (new Competition())
        ->setCollection($seasonName)
        ->where("_id", $_id)
        ->get();
        
        return view("admin/editCompetitions", ['competition' => $competition]);
    }

    public function update(Request $request, $year, $_id) {
        $seasonName = $year . "_competitions";

        $name = $request->input('name');
        $location = $request->input("address");
        $boatType = $request->input("boatType");
        $isOpen = $request->has("isOpen") ? true : false;
        
        $dateStr = $request->input("competition-date");
        $dateNotFormatted = DateTime::createFromFormat('Y-m-d', $dateStr);
        $date = $dateNotFormatted->format('d-m-Y');
        
        $price = $request->input("price");
        $sponsorsList = $request->input("sponsors-list");

        $updatedData = [
            'name' => $name,
            'location' => $location,
            'boatType' => $boatType,
            'isOpen' => $isOpen,
            'date' => $date,
            'sponsor_price' => $price,
            'sponsors_list' => $sponsorsList
        ];
        $competition = (new Competition())
        ->setCollection($seasonName)
        ->where("_id", $_id)
        ->update($updatedData);

        return redirect()->route('admin.competitions', ['lang' => app()->getLocale()])->with('succes', 'true');
    }

    public function joinCompetition(Request $request){
        //dd($request->all());
        $route = request()->path();
        $routeArray = explode('/', $route);
        $year = $routeArray[2];

        $competition_id = $routeArray[4];
        $category = $request->input("category1") . $request->input("category2");
        $teamName = $request->input("teamName");
        $teamMembersArray = $request->input("teamMembers");
        $substitutes = $request->input("substitutes");
        $substitutesTrimmed = preg_replace('/\s+/', '', $substitutes);
        $substitutesArray = explode(",", $substitutesTrimmed);
        $teamMembers = array_merge($teamMembersArray, $substitutesArray);
        $insurance = $request->input("insurance") ? $request->input("insurance") : null;
        $collectionName = $year . "_competitions_results";
        
        if (!$competitionComparator = (
            new Competition())
            ->setCollection($collectionName)
            ->where("competition_id", $competition_id)
            ->where("category", $category)
            ->where("team_name", $teamName)
            ->exists()
        ) {
            $competitionResult = new Competition;
            $competitionResult->setCollection($collectionName);
            $competitionResult->competition_id = $competition_id;
            $competitionResult->team_name = $teamName;
            $competitionResult->category = $category;
            $competitionResult->team_members = $teamMembers;
            $competitionResult->insurance = $insurance;
            $competitionResult->distance = "";
            $competitionResult->time = "";
            $competitionResult->save();
        }
    }

    public function changeIsActive(Request $request){
        $_id = $request->input("_id");
        $year = $request->input("year");
        $seasonName = $year . "_competitions";
        $newStatus = $request->input("newStatus");
        if($newStatus === "true") $newStatus = true;
        else $newStatus = false;

        $updatedData = [
            'isActive' => $newStatus
        ];

        $competition = (new Competition())
        ->setCollection($seasonName)
        ->where("_id", $_id)
        ->update($updatedData);

        return response()->json(['message' => 'Estado cambiado correctamente']);
    }

    public function changeIsCancelled(Request $request){
        $_id = $request->input("_id");
        $year = $request->input("year");
        $seasonName = $year . "_competitions";
        $newStatus = $request->input("newStatus");
        if($newStatus === "true") $newStatus = true;
        else $newStatus = false;

        $updatedData = [
            'isCancelled' => $newStatus
        ];

        $competition = (new Competition())
        ->setCollection($seasonName)
        ->where("_id", $_id)
        ->update($updatedData);

        return response()->json(['message' => 'Estado cambiado correctamente']);
    }

    //------------------CRUD-END------------------//

    //------------------VIEW-CALLS------------------//
    // Pagina principal
    public function showFrontPage($year) {
        $seasonName = $year . "_competitions";
        $currentDate = Carbon::now()->toDateString();
        $competitions = (new Competition())
        ->setCollection($seasonName)
        ->where('date', '>=', $currentDate)
        ->where('isActive', true)
        ->take(4)->get();
        $sponsors = Sponsor::where("isActive", true)->get();

        return view("frontPage", compact("competitions", "sponsors", "year"));
    }

    // Apuntarse a competicion
    public function showJoinForm($year, $_id) {
        $seasonName = $year . "_competitions";
        $competition = (new Competition())
        ->setCollection($seasonName)
        ->where("_id", $_id)
        ->first();
        
        return view("competitions/joinCompetitionSingleTeam", compact("competition", "year"));
    }

    // Ver todas las competiciones de un año
    public function showAllCompetitions($year) {
        $seasonName = $year . "_competitions";
        $competitions = (new Competition())->setCollection($seasonName)
        ->where('isActive', true)
        ->take(4)->get();

        return view("competitions/viewCompetitions", compact("competitions", "year"));
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

    //------------------ENDPOINTS-END------------------//

}
