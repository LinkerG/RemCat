<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function auth(Request $request) {

        /*request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);*/

        $email = $request->input('email');
        $password = $request->input('password');

        $user = Admin::verifyAdmin($email,$password);

        if ($user && Auth::guard('admin')->attempt(['email' => $email, 'password' => $password])) {
            session(['adminAuth' => true]);
            session(['userName' => $user->email]);
            
            return redirect()->route('admin.dashboard');
        } else {
            // Las credenciales son incorrectas o el usuario no existe
            return redirect()->route('admin.login')->with('error', 'Incorrect');
        }
    }
    
}