<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use App\Models\Insurance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use MongoDB\BSON\ObjectID;

class SponsorController extends Controller
{
    public function showAddForm(){
        return view('admin/addSponsors');
    }

    public function store(Request $request){
        $cif = $request->input('cif');
        $name = $request->input('name');
        $address = $request->input("address");

        // TODO: Hay que comprobar en servidor lo mismo que en JS, por ahora en servidor  solo se comprueba que el cif no este dupli
        $error = [];
        $parameters = [
            "cif" => $request->input('cif'),
            "name" => $request->input('name'),
        ];

        if(!Sponsor::checkIfExists($parameters) && !Insurance::checkIfExists($parameters)){
            Sponsor::storeSponsor($request);
        } else {
            $error[] = "Already exists";
        }

        // Para redirigir con el idioma hay que hacerlo asi
        return redirect()->route('admin.sponsors.add', ['lang' => app()->getLocale()])->withErrors(implode(', ', $error));
    }

    public function viewAll(){
        $sponsors = Sponsor::getAllSponsors($onlyActives = false);

        return view("admin/viewSponsors", compact("sponsors"));
    }

    public function showEditForm($_id) {
        $sponsor = Sponsor::getSponsorById($_id);

        return view("admin/editSponsors", ['sponsor' => $sponsor]);
    }

    public function update(Request $request, $_id) {
        $name = $request->input('name');
        $address = $request->input("address");


        $updatedData = [
            'name' => $name,
            'address' => $address
        ];

        $succes = Sponsor::updateSponsor($_id, $updatedData) ? true : false;

        return redirect()->route('admin.sponsors', ['lang' => app()->getLocale()])->with('succes', $succes);
    }

    public function changeIsActive(Request $request){
        $_id = $request->input("_id");
        $newStatus = $request->input("newStatus");
        if($newStatus === "true") $newStatus = true;
        else $newStatus = false;

        $updatedData = [
            'isActive' => $newStatus
        ];

        $succes = Sponsor::updateSponsor($_id, $updatedData) ? true : false;

        return response()->json(['changed' => $succes]);
    }

    // ENDPOINTS
    public function fetchAllSponsors(){
        $sponsors = Sponsor::getAllSponsors();

        return response()->json($sponsors);
    }
}
