<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function procesarFormulario(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Credenciales válidas
            return redirect()->route('admin.dashboard', ['lang' => app()->getLocale()])->with('success', 'Login successful');
        } else {
            // Credenciales inválidas
            return redirect()->route('admin.login', ['lang' => app()->getLocale()])->withErrors(['email' => 'Incorrect']);
        }
    }
    
}