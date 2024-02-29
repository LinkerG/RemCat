<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Sponsor extends Model
{
    protected $connection = "mongodb";
    protected $collection = "Sponsors";
}
