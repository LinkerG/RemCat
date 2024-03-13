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
