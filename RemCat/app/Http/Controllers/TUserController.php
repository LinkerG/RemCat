<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TUser;
use App\Models\DbData;

class TUserController extends Controller
{
    public function index(){
        
        
        
        $users = (new TUser())->setCollection('Users')->paginate(10);
        
        return view("index", compact("users"));
        
    }
}