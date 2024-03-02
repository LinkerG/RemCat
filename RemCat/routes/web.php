<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
// Controladores 
use App\Http\Controllers\TUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Definición de idioma por defecto
Route::prefix('{lang?}')->where(['lang' => 'en|es|ca'])->group(function () {

    // Página de inicio
    Route::get('/', function ($lang = 'es') {
        App::setLocale($lang);
        return view('frontPage');
    })->name('home');

    // Página de inicio de sesión de usuario
    Route::get('/login', function ($lang = 'es') {
        App::setLocale($lang);
        return view('login');
    })->name('login');

    // Página de inicio de sesión de administrador
    Route::get('/admin', function ($lang = 'es') {
        App::setLocale($lang);
        return view('admin/loginAdmin');
    })->name('admin.login');

    // Listar usuarios de prueba
    Route::get('/users', [TUserController::class, 'index'])->name('users.index');

    // Formulario de agregar patrocinadores
    Route::get('/admin/sponsors/add', function ($lang = 'es') {
        App::setLocale($lang);
        return view('admin/addSponsors');
    })->name('admin.sponsors.add');

    // Respuesta del formulario de agregar patrocinadores
    Route::post('/admin/sponsors/add', function ($lang = 'es') {
        App::setLocale($lang);
        return view('admin/addSponsors');
    });

    // Formulario de agregar aseguradoras
    Route::get('/admin/insurances/add', function ($lang = 'es') {
        App::setLocale($lang);
        return view('admin/addInsurances');
    })->name('admin.insurances.add');

    // Respuesta del formulario de agregar aseguradoras
    Route::post('/admin/insurances/add', function ($lang = 'es') {
        App::setLocale($lang);
        return view('admin/addInsurances');
    });
});
