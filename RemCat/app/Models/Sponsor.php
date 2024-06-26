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

    public static function getAllSponsors($onlyActives = true, $take = null) {
        $sponsors = Sponsor::query();

        if ($onlyActives) $sponsors->where('isActive', true);
        if ($take != null) $sponsors->take($take);

        return $sponsors->get();
    }


    public static function getSponsorById($_id){
        $query = self::query(); // Inicia una nueva instancia de consulta para el modelo Insurance

        $query->where('_id', $_id);
        $query->get();
        

        // Devuelve un booleano indicando si existe algún registro que coincida
        return $query;
    }

    public static function getSponsorByCif($cif){
        $sponsor = (new Sponsor());
        $sponsor
        ->where('cif', $cif)
        ->first();

        return $sponsor;
    }

    public static function checkIfExists($parameters)
    {
        $query = self::query(); // Inicia una nueva instancia de consulta para el modelo Insurance

        foreach ($parameters as $parameterName => $value) {
            $query->where($parameterName, $value);
        }

        // Devuelve un booleano indicando si existe algún registro que coincida
        return $query->exists();
    }

    public static function storeSponsor(Request $request){
        $sponsor = new Sponsor;
        $sponsor->cif = $request->input("cif");
        $sponsor->name = $request->input('name');
        $sponsor->address = $request->input("address");
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
