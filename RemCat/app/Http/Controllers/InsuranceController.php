<?php

namespace App\Http\Controllers;

use App\Models\Insurance;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    public function showAddForm()
    {
        return view('admin/addInsurances');
    }

    public function store(Request $request)
    {
        $cif = $request->input('cif');
        $name = $request->input('name');
        $address = $request->input("address");
        $price = $request->input("price");

        $insurance = new Insurance;
        $insurance->cif = $cif;
        $insurance->name = $name;
        $insurance->address = $address;
        $insurance->price = $price;
        $insurance->isActive = true;
        // TODO:
        //  - Hay que comprobar en servidor lo mismo que en JS, por ahora en servidor 
        //    solo se comprueba que el cif no este dupli
        //  - Hay que mirar que el cif tampoco exista en sponsors
        $error = [];
        if(!Insurance::where("cif", $cif)->exists()){
            $insurance->save();
        } else {
            $error[] = "alreadyExists";
        }
        
        // Para redirigir con el idioma hay que hacerlo asi
        return redirect()->route('admin.insurances.add', ['lang' => app()->getLocale()])->withErrors(implode(', ', $error));
    }

    public function viewAll(){
        $insurances = Insurance::all();

        return view("admin/viewInsurances", compact("insurances"));
    }

    public function showEditForm($_id) {
        $insurance = Insurance::where("_id", $_id)->first(); // Utiliza 'first()' para obtener el modelo, no solo la consulta
        
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

        $insurance = Insurance::where('_id', $_id)->update($updatedData);

        return redirect()->route('admin.insurances', ['lang' => app()->getLocale()])->with('succes', 'true');
    }
    
}
