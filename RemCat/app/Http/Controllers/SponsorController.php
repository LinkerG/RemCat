<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;

class SponsorController extends Controller
{
    public function showAddForm()
    {
        return view('admin/addSponsors');
    }

    public function add(Request $request)
    {
        // Aquí puedes procesar la lógica para agregar un nuevo sponsor
        echo "Datos enviados por el formulario";
        echo "<br>";
        $cif = $request->input('cif');
        $name = $request->input('name');
        echo $name;

        //return view("admin/addSponsors");
    }
}
