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
        var_export($request);
        $lang = $request->getLocale();
        \App::setLocale($lang);

        // Aquí puedes procesar la lógica para agregar un nuevo sponsor

        return redirect()->route('admin.sponsors.add')
            ->with('success', __('Sponsor added successfully.'));
    }
}
