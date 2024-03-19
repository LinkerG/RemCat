<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Team extends Model
{
    protected $connection = "mongodb";
    protected $collection = "Teams";

    protected $fillable = ['team_name', 'email', 'password', 'foto'];
}
