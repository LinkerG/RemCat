<?php
namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Support\Facades\Hash;

class Admin extends Model implements Authenticatable
{
    use AuthenticatableTrait;

    protected $connection = 'mongodb';
    protected $collection = 'admins';

    protected $fillable = ['email', 'password'];

}