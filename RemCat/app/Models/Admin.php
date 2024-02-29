<?php
namespace App\Models;

use Mongodb\Laravel\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Admin extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'admins';

    protected $fillable = [
        'email', 'password',
    ];

    public static function verifyAdmin($email,$password) {
        $admin = self::where('email', $email)->firstOrFail();
        if ($admin && Hash::check($password, $admin->password)) {
            return true; 
        }
        return false; 
    }
    
}