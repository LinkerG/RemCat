<?php
namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class TUser extends Model
{
    protected $connection = "mongodb";
    protected $collection;   

    public function setCollection($col){
        $this->collection = $col;
        return $this;
    }
    
}