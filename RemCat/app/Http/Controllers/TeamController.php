<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Validation\ValidationException;
use MongoDB\Laravel\Eloquent\Casts\ObjectId;

class TeamController extends Controller
{
    //------------------CRUD------------------//
    public function store(Request $request){
        $email = $request->input("email");
        $name = $request->input('name');
        $password = $request->input("password");
        $passwordEncrypted = Hash::make($password);
        //TODO : Imagen
        $filename = ImageController::storeImage(request(), 'teams/photos', 'team-photo', $email);

        $team = new Team;
        $team->team_name = $name;
        $team->email = $email;
        $team->password = $passwordEncrypted;
        $team->photo = $filename;

        $team->save();

        return redirect()->route('login', ['lang' => app()->getLocale()]);
    }

    public function logout() {
        Auth::guard('team')->logout();

        session()->flush();

        return redirect()->route('home', ['lang' => app()->getLocale()]);
    }

    //------------------CRUD-END------------------//

    //------------------ENDPOINTS------------------//

    //------------------ENDPOINTS-END------------------//
}