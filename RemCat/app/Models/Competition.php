<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Competition extends Model
{
    protected $connection = "mongodb";
    protected $collection;   

    public function setCollection($col){
        $this->collection = $col;
        return $this;
    }
}
