<?php

namespace App\Http\Controllers;

use App\Models\Insurance;
use App\Models\Sponsor;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    public function showAddForm()
    {
        return view('admin/addInsurances');
    }

    public function store(Request $request)
    {
        $error = [];
        $parameters = [
            "cif" => $request->input('cif'),
        ];

        // echo "CIF from request: " . $request->input("cif") . "<br>";

        // // Depuración: Verificar los parámetros
        // echo '<pre>';
        // print_r($parameters);
        // echo '</pre>';

        // Comprobación de existencia en Sponsor y Insurance
        $sponsorExists = Sponsor::checkIfExists($parameters);
        $insuranceExists = Insurance::checkIfExists($parameters);

        // echo "Sponsor exists: " . ($sponsorExists ? 'true' : 'false') . "<br>";
        // echo "Insurance exists: " . ($insuranceExists ? 'true' : 'false') . "<br>";

        if (!$sponsorExists && !$insuranceExists) {
            Insurance::storeInsurance($request);
        } else {
            $error[] = "alreadyExists";
        }

        // // Depuración: Mostrar errores
        // echo '<pre>';
        // print_r($error);
        // echo '</pre>';

        return redirect()->route('admin.insurances', ['lang' => app()->getLocale()])->withErrors(implode(', ', $error));
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
