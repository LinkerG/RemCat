<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class UserController extends Controller
{
    //------------------CRUD------------------//
    public function store(Request $request){
        $email = $request->input("email");
        $name = $request->input('name');
        $password = $request->input("password");
        $passwordEncrypted = Hash::make($password);
        //TODO : Imagen

        $user = new User;
        $user->user_name = $name;
        $user->email = $email;
        $user->password = $passwordEncrypted;

        $errors = [];
        if((!Team::where("email", $email)->exists()) && (!User::where("email", $email)->exists())){
            $user->save();
        } else {
            $error[] = "alreadyExists";
        }

        return empty($errors) ? redirect()->route('login', ['lang' => app()->getLocale()])->withErrors(implode(', ', $errors)) : redirect()->route('login', ['lang' => app()->getLocale()])->withErrors(implode(', ', $errors));
        
    }

    //------------------CRUD-END------------------//

    //------------------ENDPOINTS------------------//
    public function matchEmail(Request $request){
        $email = $request->input('email');
        
        $exists = false;
        if(User::where("email", $email)->exists()) $exists = true;
        if(!$exists){
            if(Team::where("email", $email)->exists()) $exists = true;
        }
        $json;
        
        return $exists ? response()->json(['exists' => true]) : response()->json(['exists' => false]);

    }
    
    //------------------ENDPOINTS-END------------------//
}
