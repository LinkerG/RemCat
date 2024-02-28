<?php
namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class DbData extends Model
{   
    protected $connection = "mongodb";
    protected $collection = 'default_collection';

    

    public function setCollection($collection)
    {
        $instance = new self();
        $instance->collection = $collection;
        return $instance;
    }
}