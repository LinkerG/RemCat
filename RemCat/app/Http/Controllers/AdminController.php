<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function auth() {

        request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = request()->input('email');
        $password = request()->input('password');
        
        $user = Admin::where('email', $email)->first();
        if ($user && Auth::guard('admin')->attempt(['email' => $email, 'password' => $password])) {
            session(['adminAuth' => true]);
            session(['userName' => $user->email]);

            return redirect()->route('admin.dashboard', ['lang' => app()->getLocale()]);
        } else {
            // Las credenciales son incorrectas o el usuario no existe
            return redirect()->route('admin.login', ['lang' => app()->getLocale()]);
        }
    }

    public function logout() {
        Auth::guard('admin')->logout();

        session()->flush();

        return redirect()->route('admin.login', ['lang' => app()->getLocale()]);
    }

    public function dynamicContent($page) {

        switch ($page) {
            case 'dashboard':
                return view('admin/dashboard');
            case 'competitions':
                return view('admin/viewCompetitions');
            case 'teams':
                return view('admin/equipos');
            case 'sponsors':
                return view('admin/viewSponsors');
            case 'insurances':
                return view('admin/viewInsurances');
            default:
                abort(404);
        }
    }
    
}