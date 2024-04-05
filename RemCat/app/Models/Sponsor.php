<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\ImageController;

class Sponsor extends Model
{
    protected $connection = "mongodb";
    protected $collection = "Sponsors";

    public static function getAllSponsors($onlyActives = true, $take=null){
        $sponsors = (new Sponsor());
        $sponsors
        ->where('isActive', $onlyActives)
        ->get();
        if($take != null) $sponsors = $sponsors->take($take);

        return $sponsors;
    }

    public static function getSponsorById($_id){
        $sponsor = (new Sponsor());
        $sponsor
        ->where('_id', $_id)
        ->first();

        return $sponsor;
    }

    public static function getSponsorByCif($cif){
        $sponsor = (new Sponsor());
        $sponsor
        ->where('cif', $cif)
        ->first();

        return $sponsor;
    }

    public static function checkIfExists($parameters){
        $comparator = (new Sponsor());
        foreach ($parameters as $parameterName => $value) {
            $comparator->where($parameterName, $value);
        }
        
        return $comparator->exists();
    }

    public static function storeSponsor(Request $request){
        $sponsor = new Sponsor;
        $sponsor->cif = $request->input("cif");
        $sponsor->name = $request->input('name');
        $sponsor->address = $request->input("address");
        $sponsor->price = $request->input("price");
        $sponsor->isActive = true;

        $sponsor->save();
    }

    public static function updateSponsor($_id, $updatedData){
        $sponsor = (new Sponsor())
        ->where("_id", $_id)
        ->update($updatedData);

        return true;
    }
}
