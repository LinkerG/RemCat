<?php
namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class TUser extends Model
{
    protected $connection = "mongodb";
    protected $collection = "Users";
    
}