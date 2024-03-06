<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
// Controladores 
use App\Http\Controllers\TUserController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\AdminController;

// RUTAS DE LA WEB

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
    Route::post('/admin', function (Request $request, $lang = 'es') {
        $adminController = new AdminController();
        App::setLocale($lang);

        return $adminController->procesarFormulario($request);
    });
    
    Route::get('/dashboard', function ($lang = 'es') {
        App::setLocale($lang);
        
        return view('admin/adminStart');
    })->name('admin.dashboard');

    // Listar usuarios de prueba
    Route::get('/users', [TUserController::class, 'index'])->name('users.index');

    // Formulario de agregar sponsors
    Route::get('/admin/sponsors/add', function ($lang = 'es') {
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

    // Ver todos los sponsors
    Route::get('/admin/sponsors', function ($lang = 'es') {
        $sponsorController = new SponsorController();
        App::setLocale($lang);
        return $sponsorController->viewAll();
    })->name('admin.sponsors');

    // Editar un sponsor
    Route::get('/admin/sponsors/edit/{_id}', function ($lang = 'es', $_id) {
        $sponsorController = new SponsorController();
        App::setLocale($lang);

        return $sponsorController->showEditForm($_id);
    })->name('admin.sponsors.edit');

    // Respuesta a editar un sponsor
    Route::post('/admin/sponsors/edit/{_id}', function (Request $request, $lang = 'es', $_id) {
        $sponsorController = new SponsorController();
        App::setLocale($lang);
        
        return $sponsorController->update($request, $_id);
    });

    // Formulario de agregar aseguradoras
    Route::get('/admin/insurances/add', function ($lang = 'es') {
        $insuranceController = new InsuranceController();
        App::setLocale($lang);

        return $insuranceController->showAddForm();
    })->name('admin.insurances.add');

    // Respuesta del formulario de agregar aseguradoras
    Route::post('/admin/insurances/add', function (Request $request, $lang = 'es') {
        $insuranceController = new InsuranceController();
        App::setLocale($lang);
        
        return $insuranceController->store($request);
    });

    // Ver todas las aseguradoras
    Route::get('/admin/insurances', function ($lang = 'es') {
        $insuranceController = new InsuranceController();
        App::setLocale($lang);
        return $insuranceController->viewAll();
    })->name('admin.insurances');

    // Editar una aseguradora
    Route::get('/admin/insurances/edit/{_id}', function ($lang = 'es', $_id) {
        $insuranceController = new InsuranceController();
        App::setLocale($lang);

        return $insuranceController->showEditForm($_id);
    })->name('admin.insurances.edit');

    // Respuesta a editar una aseguradora
    Route::post('/admin/insurances/edit/{_id}', function (Request $request, $lang = 'es', $_id) {
        $insuranceController = new InsuranceController();
        App::setLocale($lang);
        
        return $insuranceController->update($request, $_id);
    });

    // Formulario de agregar competiciones
    Route::get('/admin/competitions/add', function ($lang = 'es') {
        App::setLocale($lang);
        return view('admin/addCompetitions');
    })->name('admin.competitions.add');

    // Respuesta del formulario de agregar competiciones
    Route::post('/admin/competitions/add', function (Request $request, $lang = 'es') {
        $competitionController = new CompetitionController();
        App::setLocale($lang);
        
        return $competitionController->store($request);
    });
});


// ENDPOINTS      ---   Sobre todo para recuperar JSON desde JavaScript

// Fetch sponsors
Route::get('/api/sponsors/fetchAll', [SponsorController::class, 'fetchAllSponsors']);
Route::get('api/competitons/fetchYears', [CompetitionController::class, 'fetchYears']);