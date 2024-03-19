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
    public function auth() {
        request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = request()->input('email');
        $password = request()->input('password');

        $team = Team::where('email',$email)->first();
        if($team && Auth::guard('team')->attempt(['email'=>$email, 'password'=>$password])) {
            session(['teamAuth' => true]);
            session(['teamName' => $team->team_name]);
            session(['teamFoto' => $team->foto]);

            return redirect()->route('team.frontPage',['lang' => app()->getLocale()]);
        } else {
            return redirect()->route('login', ['lang' => app()->getLocale()]);
        }
    }

    //------------------CRUD-END------------------//

    //------------------ENDPOINTS------------------//

    //------------------ENDPOINTS-END------------------//
}