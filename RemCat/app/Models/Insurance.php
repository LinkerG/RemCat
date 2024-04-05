<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use MongoDB\Laravel\Eloquent\Model;

class Insurance extends Model
{
    protected $connection = "mongodb";
    protected $collection = "Insurances";

    public static function getAllInsurances($onlyActives = true, $take=null){
        $insururances = (new Insurance());
        $insururances
        ->where('isActive', $onlyActives)
        ->get();
        if($take != null) $insururances = $insururances->take($take);

        return $insururances;
    }

    public static function getInsuranceById($_id){
        $insururance = (new Insurance());
        $insururance
        ->where('_id', $_id)
        ->first();

        return $insururance;
    }

    public static function getInsuranceByCif($cif){
        $insururance = (new Insurance());
        $insururance
        ->where('cif', $cif)
        ->first();

        return $insururance;
    }

    public static function checkIfExists($parameters){
        $comparator = (new Insurance());
        foreach ($parameters as $parameterName => $value) {
            $comparator->where($parameterName, $value);
        }
        
        return $comparator->exists();
    }

    public static function storeInsurance(Request $request){
        $insurance = new Insurance;
        $insurance->cif = $request->input("cif");
        $insurance->name = $request->input('name');
        $insurance->address = $request->input("address");
        $insurance->price = $request->input("price");
        $insurance->isActive = true;

        $insurance->save();
    }

    public static function updateInsurance($_id, $updatedData){
        $insurance = (new Insurance())
        ->where("_id", $_id)
        ->update($updatedData);

        return true;
    }
}
