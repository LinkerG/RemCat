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
    protected $collection = 'Admins';

    protected $fillable = ['email', 'password'];

    public static function verifyAdmin($email,$password) {
        $admin = self::where('email', $email)->firstOrFail();
        if ($admin && Hash::check($password, $admin->password)) {
            return true; 
        }
        return false; 
    }
}