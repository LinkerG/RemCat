<?php

namespace App\Http\Controllers;

use App\Models\Insurance;
use Illuminate\Http\Request;
use App\Models\Sponsor;

class InsuranceController extends Controller
{
    public function showAddForm()
    {
        return view('admin/addInsurances');
    }

    public function store(Request $request)
    {
        //   TODO: Hay que comprobar en servidor lo mismo que en JS, por ahora en servidor solo se comprueba que el cif no este dupli
        $error = [];
        $parameters = [
            "cif" => $request->input('cif'),
        ];
        if(!Sponsor::checkIfExists($parameters) || !Insurance::checkIfExists($parameters)){
            Insurance::storeInsurance($request);
        } else {
            $error[] = "alreadyExists";
        }

        return redirect()->route('admin.insurances.add', ['lang' => app()->getLocale()])->withErrors(implode(', ', $error));
    }

    public function viewAll(){
        $insurances = Insurance::getAllInsurances($onlyActives = false);

        return view("admin/viewInsurances", compact("insurances"));
    }

    public function showEditForm($_id) {
        $insurance = Insurance::getInsuranceById($_id);

        return view("admin/editInsurances", ['insurance' => $insurance]);
    }

    public function update(Request $request, $_id) {
        $name = $request->input('name');
        $address = $request->input("address");
        $price = $request->input("price");

        $updatedData = [
            'name' => $name,
            'address' => $address,
            'price' => $price
        ];

        $succes = Insurance::updateInsurance($_id, $updatedData) ? true : false;

        return redirect()->route('admin.insurances', ['lang' => app()->getLocale()])->with('succes', $succes);
    }

    public function changeIsActive(Request $request){
        $_id = $request->input("_id");
        $newStatus = $request->input("newStatus");
        if($newStatus === "true") $newStatus = true;
        else $newStatus = false;

        $updatedData = [
            'isActive' => $newStatus
        ];

        $succes = Insurance::updateInsurance($_id, $updatedData) ? true : false;

        return response()->json(['changed' => $succes]);
    }

    public function getAllInsurances() {
        
    }
}
