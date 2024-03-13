<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Insurance extends Model
{
    protected $connection = "mongodb";
    protected $collection = "Insurances";
}
