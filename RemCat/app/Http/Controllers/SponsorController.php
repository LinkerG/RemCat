<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SponsorController extends Controller
{
    public function showAddForm()
    {
        return view('admin/addSponsors');
    }

    public function store(Request $request)
    {
        $cif = $request->input('cif');
        $name = $request->input('name');
        $address = $request->input("address");
        
        $uploadPath = public_path('uploads/sponsors');
        if (!File::isDirectory($uploadPath)) {
            File::makeDirectory($uploadPath, 0777, true, true);
        }

        // TODO: Esto no funciona
        if ($request->hasFile('image-logo')) {
            $image = $request->file('image-logo');

            $fileName = 'sponsor_' . $cif . '.' . $image->getClientOriginalExtension();
            // Mueve el archivo a la carpeta uploads/sponsors
            $image->move($uploadPath, $fileName);

        } else $fileName = "sponsor_default.png";

        $sponsor = new Sponsor;
        $sponsor->cif = $cif;
        $sponsor->name = $name;
        $sponsor->address = $address;
        $sponsor->logo = $fileName;
        // TODO:
        //  - Hay que comprobar en servidor lo mismo que en JS, por ahora en servidor 
        //    solo se comprueba que el cif no este dupli
        $error = [];
        if(!Sponsor::where("cif", $cif)->exists()){
            $sponsor->save();
        } else {
            $error[] = "alreadyExists";
        }
        
        // Para redirigir con el idioma hay que hacerlo asi
        return redirect()->route('admin.sponsors.add', ['lang' => app()->getLocale()])->withErrors(implode(', ', $error));
    }
}
