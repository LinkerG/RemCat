<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class User extends Model implements Authenticatable
{
    use AuthenticatableTrait;
    
    protected $connection = "mongodb";
    protected $collection = "Users";

    protected $fillable = ['name','email', 'password','foto'];
}
