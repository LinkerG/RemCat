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

class LoginController extends Controller{
    //--------------Auth-----------------//
    public function auth() {
        request()->validate([
            'email' => ['required', 'email', 'string'],
            'password' => ['required', 'string']
        ]);

        $email = request()->input('email');

        $team = Team::where('email',$email)->first();
        $user = User::where('email',$email)->first();

        if($team && Auth::guard('team')->attempt(request()->only('email','password'))) {  
            session(['teamAuth' => true]);
            session(['teamName' => $team->team_name]);
            session(['teamFoto' => $team->foto]);

            return redirect()->route('home',['lang' => app()->getLocale()]);

        }else if($user && Auth::guard('user')->attempt(request()->only('email','password'))){
            session(['userAuth' => true]);
            session(['userName' => $user->name]);
            session(['userFoto' => $user->foto]);

            return redirect()->route('home',['lang' => app()->getLocale()]);
        } else {
            if($team || $user) {
                throw ValidationException::withMessages([
                    'password' => 'La contraseña es incorrecta, prueba otra vez.'
                ]);
            } else {
                throw ValidationException::withMessages([
                    'email' => 'El email es incorrecto, prueba otra vez.',
                    'password' => 'La contraseña es incorrecta, prueba otra vez.'
                ]);
            }
        }
    }
    //-------------------END-POINTS-LOGIN---------------------//
    public function matchEmail() {
        $email = request()->input('email');
        $password = request()->input("password");
        
        $exists = false;
        $valid = false;
        $isUser = false;
        // Buscar usuario y equipo por correo electrónico
        $user = User::where('email', $email)->first();
        $team = Team::where('email', $email)->first();
        if ($user) {
            if (Hash::check($password, $user->password)) {
                $valid = true;
                $isUser = true;
            }
            $exists = true;
        } else if($team){
            if (Hash::check($password, $team->password)) {
                $valid = true;
            }
            $exists = true;
        }

        return response()->json(['exists' => $exists, 'valid' => $valid, "isUser" => $isUser]);
    }
}

?>