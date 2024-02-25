<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TUser;

class TUserController extends Controller
{
    public function index(){
        $users = TUser::all();
        return view("index", compact("users"));
        
    }
}