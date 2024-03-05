<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CompetitionController extends Controller
{
    public function showAddForm(){
        return view('admin/addSponsors');
    }

    public function store(Request $request){
        $name = $request->input('name');
        $location = $request->input("address");
        $boatType = $request->input("boatType");
        $isOpen = $request->has("isOpen") ? true : false;
        $price = $request->input("price");
        $sponsorsList = $request->input("sponsors-list");
        
        $uploadPath = public_path('uploads/sponsors');
        if (!File::isDirectory($uploadPath)) {
            File::makeDirectory($uploadPath, 0777, true, true);
        }

        // TODO: Esto no funciona
        if ($request->hasFile('image-map')) {
            $image = $request->file('image-map');

            $fileName = 'sponsor_' . $cif . '.' . $image->getClientOriginalExtension();
            // Mueve el archivo a la carpeta uploads/sponsors
            $image->move($uploadPath, $fileName);

        } else $fileName = "map_default.png";

        $competition = new Competition;
        $competition->setCollection("23_24_competitions");
        $competition->name = $name;
        $competition->location = $location;
        $competition->boatType = $boatType;
        $competition->isOpen = $isOpen;
        $competition->sponsor_price = $price;
        $competition->sponsors_list = $sponsorsList;
        $competition->image_map = $fileName;

        $error = [];
        $competition->save();
        
        // Para redirigir con el idioma hay que hacerlo asi
        return redirect()->route('admin.competitions.add', ['lang' => app()->getLocale()])->withErrors(implode(', ', $error));
    }
}
