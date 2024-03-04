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
        // Aquí puedes procesar la lógica para agregar un nuevo sponsor
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
            // Aquí puedes hacer más cosas si es necesario

        } else $fileName = "sponsor_default.png";

        $sponsor = new Sponsor;
        $sponsor->cif = $cif;
        $sponsor->name = $name;
        $sponsor->address = $address;
        $sponsor->logo = $fileName;

        $error = [];
        if(!Sponsor::where("cif", $cif)->exists()){
            $sponsor->save();
        } else {
            // Esto es temporal
            echo "
            <div class='alert alert-danger alert-dismissible fade show'>
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                <strong>Error!</strong> Ya existe un sponsor con ese CIF.
            </div>
            ";
            $error[] = "alreadyExists";
        }
        
        // Para redirigir con el idioma hay que hacerlo asi
        return redirect()->route('admin.sponsors.add', ['lang' => app()->getLocale()])->withErrors(implode(', ', $error));
    }
}
