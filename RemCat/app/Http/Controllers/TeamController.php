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

class TeamController extends Controller
{
    //------------------CRUD------------------//
    public function store(Request $request){
        $email = $request->input("email");
        $name = $request->input('name');
        $password = $request->input("password");
        $passwordEncrypted = Hash::make($password);
        //TODO : Imagen

        $team = new Team;
        $team->team_name = $name;
        $team->email = $email;
        $team->password = $passwordEncrypted;

        $errors = [];
        if((!Team::where("email", $email)->exists()) && (!User::where("email", $email)->exists())){
            $team->save();
        } else {
            $error[] = "alreadyExists";
        }

        return empty($errors) ? redirect()->route('login', ['lang' => app()->getLocale()])->withErrors(implode(', ', $errors)) : redirect()->route('login', ['lang' => app()->getLocale()])->withErrors(implode(', ', $errors));
        
    }

    //------------------CRUD-END------------------//

    //------------------ENDPOINTS------------------//
    //------------------ENDPOINTS-END------------------//
}