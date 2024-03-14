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
        
        
        // TODO:
        //  - Hay que comprobar en servidor lo mismo que en JS, por ahora en servidor 
        //    solo se comprueba que el cif no este dupli
        //  - Hay que mirar que el cif tampoco exista en insurance

        $error = [];
        if(!Sponsor::where("cif", $cif)->exists() && !Insurance::where("cif", $cif)->exists()){
            $_id = new ObjectID();
            $fileName = ImageController::storeImage(request(), "sponsors/logos", "image-logo" ,$_id);

            $sponsor = new Sponsor;
            $sponsor->_id = $_id;
            $sponsor->cif = $cif;
            $sponsor->name = $name;
            $sponsor->address = $address;
            $sponsor->image_logo = $fileName;
            $sponsor->isActive = true;
            $sponsor->save();
        } else {
            $error[] = "alreadyExists";
        }
        
        // Para redirigir con el idioma hay que hacerlo asi
        return redirect()->route('admin.sponsors.add', ['lang' => app()->getLocale()])->withErrors(implode(', ', $error));
    }

    public function viewAll(){
        $sponsors = Sponsor::all();

        return view("admin/viewSponsors", compact("sponsors"));
    }

    public function showEditForm($_id) {
        $sponsor = Sponsor::where("_id", $_id)->first(); // Utiliza 'first()' para obtener el modelo, no solo la consulta
        
        return view("admin/editSponsors", ['sponsor' => $sponsor]);
    }

    public function update(Request $request, $_id) {
        $name = $request->input('name');
        $address = $request->input("address");
        

        $updatedData = [
            'name' => $name,
            'address' => $address
        ];

        $sponsor = Sponsor::where('_id', $_id)->update($updatedData);

        return redirect()->route('admin.sponsors', ['lang' => app()->getLocale()])->with('succes', 'true');
    }

    public function changeIsActive(Request $request){
        $_id = $request->input("_id");
        $newStatus = $request->input("newStatus");
        if($newStatus === "true") $newStatus = true;
        else $newStatus = false;

        $updatedData = [
            'isActive' => $newStatus
        ];

        $sponsor = Sponsor::where('_id', $_id)->update($updatedData);

        return response()->json(['message' => 'Estado cambiado correctamente']);
    }

    // ENDPOINTS
    public function fetchAllSponsors(){
        $sponsors = Sponsor::all();
        return response()->json($sponsors);
    }
}
