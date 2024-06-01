<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use App\Helpers\CalcSeason;
use DateTime;
use Carbon\Carbon;
use MongoDB\BSON\ObjectID;
use Illuminate\Http\Request;
use App\Http\Controllers\ImageController;

class Competition extends Model
{
    protected $connection = "mongodb";
    protected $collection;   

    public function setCollection($col){
        $this->collection = $col;
        return $this;
    }

    public static function getAllCompetitions($year, $dateRestriction = true, $onlyActives = true, $take=null){
        $currentDate = Carbon::now()->toDateString();
        $seasonName = $year . "_competitions";

        $competitions = (new Competition())
        ->setCollection($seasonName)
        ->get();
        if($onlyActives) $competitions = $competitions->where('isActive', true);
        if($dateRestriction) $competitions = $competitions->where('date', '>=', $currentDate);
        if($take != null) $competitions = $competitions->take($take);

        
        return $competitions;
    }

    public static function getCompetitionById($year, $_id){
        $seasonName = $year . "_competitions";

        $competition = (new Competition())
        ->setCollection($seasonName)
        ->where("_id", $_id)
        ->first();

        return $competition;
    }

    public static function getCompetitionsByTeam($year, Request $request){
        $collectionName = $year . "_competitions_results";
        $competitions = (
            new Competition())
            ->setCollection($collectionName)
            ->where("competition_id", $request->input("competition_id"))
            ->where("teamName", $request->input("teamName"))
            ->get();

        return $competitions;
    }

    public static function getResultsFromCompetition(Request $request){
        $year = $request->input("year");
        $collectionName = $year . "_competitions_results";
        $results = (
            new Competition())
            ->setCollection($collectionName)
            ->where("competition_id", $request->input("competition_id"))
            ->get();

        return $results;
    }

    public static function getCompetitionResult($year, $competition_id){
        $collectionName = $year . "_competitions_results";
        $results = (
            new Competition())
            ->setCollection($collectionName)
            ->where("competition_id", $competition_id)
            ->get();

        return $results;
    }

    public static function checkIfExists($collection, $parameters){
        $comparator = (new Competition())
        ->setCollection($collection)
        ->where($parameters);
        
        return $comparator->exists();
    }

    public static function storeCompetition($year, Request $request){
        $seasonName = $year . "_competitions";
        $_id = new ObjectID();
        $dateStr = $request->input("competition-date");
        $dateTime = DateTime::createFromFormat('Y-m-d', $dateStr);
        $date = Carbon::parse($dateTime)->toDateString();
        $mapImage = ImageController::storeImage($request, "competition-maps", "image-map" ,$_id);
        $bannerImage = ImageController::storeImage($request, "competition-banners", "image-banner" ,$_id);
        
        $competition = new Competition;
        $competition->setCollection($seasonName);
        $competition->name = $request->input('name');
        $competition->location = $request->input('location');
        $competition->boatType = $request->input('boatType');
        $competition->isOpen = $request->has("isOpen") ? true : false;
        $competition->date = $date;
        $competition->sponsor_price = $request->input('price');
        $competition->sponsors_list = $request->input('sponsors-list');
        $competition->image_map = $mapImage;
        $competition->image_banner = $bannerImage;
        $competition->isCancelled = false;
        $competition->isActive = true;
        $competition->save();

        return true;
    }

    public static function updateCompetition($year, $_id, $updatedData){
        $seasonName = $year . "_competitions";

        $competition = (new Competition())
        ->setCollection($seasonName)
        ->where("_id", $_id)
        ->update($updatedData);

        return true;
    }

    public static function joinCompetition($year, Request $request, $competition_id){
        $collectionName = $year . "_competitions_results";
        $teamMembersArray = $request->input("teamMembers");
        if(!is_array($teamMembersArray)) $teamMembersArray = explode(",", $teamMembersArray);
        $substitutes = $request->input("substitutes");
        $substitutesTrimmed = preg_replace('/\s*,\s*/', ',', $substitutes);
        $substitutesArray = explode(",", $substitutesTrimmed);
        $teamMembers = array_merge($teamMembersArray, $substitutesArray);

        $competitionResult = new Competition;
        $competitionResult->setCollection($collectionName);
        $competitionResult->competition_id = $competition_id;
        $competitionResult->teamName = $request->input("teamName");
        $competitionResult->category = $request->input("category1") . $request->input("category2");
        $competitionResult->teamMembers = $teamMembers;
        $competitionResult->insurance = $request->input("insurance") ? $request->input("insurance") : null;
        $competitionResult->distance = "";
        $competitionResult->time = "DNS";
        $competitionResult->timeValidated = false;
        $competitionResult->isLive = false;
        $competitionResult->save();

        return true;
    }

    public static function setTimesForCompetition($year, $competition_id, $times) {
        $collectionName = $year . "_competitions_results";
        foreach($times as $time) {
            $resultId = $time['id'];
            $newTime = $time['value'];
            $updatedData = ["time" => $newTime];

            $updateResult = (new Competition())
            ->setCollection($collectionName)
            ->where("_id", $resultId)
            ->update($updatedData);
        }
    }

    public static function getCompetitionsForToday($name) {
        $date = new DateTime();
        $date = $date->format('Y-m-d');
        $year = CalcSeason::calculate();
        
        // Obtener los IDs de las competiciones de hoy
        $competitionsToday = (new Competition())
            ->setCollection($year . "_competitions")
            ->where("date", $date)
            ->pluck('_id')
            ->toArray(); // Asegurarse de que es un array
    
        // Obtener las competiciones para el usuario basadas en los IDs de las competiciones de hoy
        $competitionsForUser = (new Competition())
            ->setCollection($year . "_competitions_results")
            ->where("teamName", $name)
            ->whereIn("competition_id", $competitionsToday)
            ->get();

        return $competitionsForUser;
    }

    public static function validateTime($result_id){
        $year = CalcSeason::calculate();
        $collectionName = $year . "_competitions_results";

        $updatedData = ["timeValidated" => true];

        $updateResult = (new Competition())
        ->setCollection($collectionName)
        ->where("_id", $result_id)
        ->update($updatedData);
    }
}
