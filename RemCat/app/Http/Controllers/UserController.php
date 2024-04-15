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
use MongoDB\Laravel\Eloquent\Casts\ObjectId;

class UserController extends Controller
{
    //------------------CRUD------------------//
    public function store(Request $request){
        $email = $request->input("email");
        $name = $request->input('name');
        $password = $request->input("password");
        $passwordEncrypted = Hash::make($password);
        //TODO : Imagen
        $filename = ImageController::storeImage(request(), 'users/photos', 'user-photo', $email);

        $user = new User;
        $user->user_name = $name;
        $user->email = $email;
        $user->password = $passwordEncrypted;
        $user->profilePhoto = $filename;
        
        $user->save();
        return redirect()->route('login', ['lang' => app()->getLocale()]);    
    }

    public function logout() {
        Auth::guard('user')->logout();

        session()->flush();

        return redirect()->route('home', ['lang' => app()->getLocale()]);
    }
    //------------------CRUD-END------------------//
    
    //------------------ENDPOINTS------------------//
    
    
    //------------------ENDPOINTS-END------------------//
}
