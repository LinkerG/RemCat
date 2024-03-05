<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function procesarFormulario(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (Admin::verifyAdmin($email, $password)) {
            // Credenciales válidas
            return redirect()->route('admin.login', ['lang' => app()->getLocale()])->with('success', 'Login successful');
        } else {
            // Credenciales inválidas
            return redirect()->route('admin.login', ['lang' => app()->getLocale()])->with('Error', 'Error');
        }
    }
    
}