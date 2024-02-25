<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TUser;

class UserController extends Controller
{
    public function index(){
        try {
            $users = TUser::all();
            return view("index", compact("users"));
        } catch (\Exception $e) {
            // Manejar el error de alguna manera
            dd($e->getMessage()); // Imprimir el mensaje de error para depuración
        }
        
    }
}
