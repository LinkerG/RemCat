<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Team extends Model implements Authenticatable
{
    use AuthenticatableTrait;
    
    protected $connection = "mongodb";
    protected $collection = "Teams";

    protected $fillable = ['team_name', 'email', 'password', 'foto'];
}
