<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;

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

    /*public function auth() {
        request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = request()->input('email');
        $password = request()->input('password');

        $user = User::where('email',$email)->first();
        if($user && Auth::guard('user')->attempt(['email'=>$email, 'password'=>$password])) {
            session(['userAuth' => true]);
            session(['userName' => $user->name]);
            session(['userFoto' => $user->foto]);

            return redirect()->route('home',['lang' => app()->getLocale()]);
        } else {
            return redirect()->route('login', ['lang' => app()->getLocale()]);
        }
    }*/
    public function logout() {
        Auth::guard('user')->logout();

        session()->flush();

        return redirect()->route('home', ['lang' => app()->getLocale()]);
    }
    //------------------CRUD-END------------------//
    
    //------------------ENDPOINTS------------------//
    
    
    //------------------ENDPOINTS-END------------------//
}
