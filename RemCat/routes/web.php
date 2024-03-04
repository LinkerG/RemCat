<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
// Controladores 
use App\Http\Controllers\TUserController;
use App\Http\Controllers\SponsorController;

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

    // Formulario de agregar sponsors
    Route::get('/admin/sponsors/add', function ($lang = 'es') {
        // ALEX BORRA ESTO CUANDO LO LEAS
        // Antes de que te de un ictus, esta es la unica forma que he encontrado para 
        // llamar a un controlador conservando el idioma asi que o encuentras otra
        // manera o lo hacemos asi, le preguntare a la olga
        $sponsorController = new SponsorController();
        App::setLocale($lang);

        return $sponsorController->showAddForm();
    })->name('admin.sponsors.add');

    // Respuesta del formulario de agregar sponsors
    Route::post('/admin/sponsors/add', function (Request $request, $lang = 'es') {
        $sponsorController = new SponsorController();
        App::setLocale($lang);
        
        return $sponsorController->store($request);
    })->name('admin.sponsor.store');

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

    // Formulario de agregar competiciones
    Route::get('/admin/competitions/add', function ($lang = 'es') {
        App::setLocale($lang);
        return view('admin/addCompetitions');
    })->name('admin.competitions.add');

    // Respuesta del formulario de agregar competiciones
    Route::post('/admin/competitions/add', function ($lang = 'es') {
        App::setLocale($lang);
        return view('admin/addCompetitions');
    });
});
