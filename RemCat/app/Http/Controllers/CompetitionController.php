<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

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
        
        $dateStr = $request->input("competition-date");
        $dateNotFormatted = DateTime::createFromFormat('Y-m-d', $dateStr);
        $date = $dateNotFormatted->format('d-m-y');
        
        $price = $request->input("price");
        $sponsorsList = $request->input("sponsors-list");
        
        // Para calcular el año
        $currentYear = date('Y');
        $currentDate = date('Y-m-d');
        
        if (date('m', strtotime($currentDate)) < 9){
            $seasonName = (intval(substr($currentYear, -2)) - 1) . "_" . intval(substr($currentYear, -2)) . "_competitions";
        } else {
            $seasonName = intval(substr($currentYear, -2)) . "_" . (intval(substr($currentYear, -2)) + 1) . "_competitions";
        }
        // se puede setear la variable de arriba para forzar temporadas anteriores o futuras
        // $seasonName = "24_25_competitions";
        
        $uploadPath = public_path('uploads/' . $seasonName);
        if (!File::isDirectory($uploadPath)) {
            File::makeDirectory($uploadPath, 0777, true, true);
        }
        
        // TODO: Esto no funciona
        if ($request->hasFile('image-map')) {
            $image = $request->file('image-map');

            $fileName =  $date . '_' . $seasonName . '.' . $image->getClientOriginalExtension();
            // Mueve el archivo a la carpeta uploads/sponsors
            $image->move($uploadPath, $fileName);

        } else $fileName = "map_default.png";
        
        $competition = new Competition;
        $competition->setCollection($seasonName);
        $competition->name = $name;
        $competition->location = $location;
        $competition->boatType = $boatType;
        $competition->isOpen = $isOpen;
        $competition->date = $date;
        $competition->sponsor_price = $price;
        $competition->sponsors_list = $sponsorsList;
        $competition->image_map = $fileName;

        $error = [];
        if (!Competition::where("name", $name)->where("boatType", $boatType)->where("date", $date)->exists()) {
            $competition->save();
        }
        
        // Para redirigir con el idioma hay que hacerlo asi
        return redirect()->route('admin.competitions.add', ['lang' => app()->getLocale()])->withErrors(implode(', ', $error));
    }

    public function fetchYears(){
        $collections = [];

        $mongoCollections = DB::connection('mongodb')->listCollections();

        foreach ($mongoCollections as $collection) {
            if (preg_match("/^\d{2}_\d{2}_competitions$/", $collection->getName())) {
                $collections[] = $collection->getName();
            }
        }

        return response()->json($collections);
    
    }
}
