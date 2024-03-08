<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Helpers\CalcSeason;
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
    
    //------------------ADMIN------------------//
    Route::prefix('/admin')->group(function() {
        //Login de admin
        Route::get('', function ($lang = 'es') {
            App::setLocale($lang);

            return view('admin/loginAdmin');
        })->name('admin.login');
        //Post del login de admin
        Route::post('', function ($lang = 'es') {
            $adminController = new AdminController();
            App::setLocale($lang);  
    
            return $adminController->auth();
        })->name('admin.login.post');

        //Middleware para el admin si esta logeado correctamente
        Route::middleware(['admin.auth'])->group(function () {
            //Pagina inicial admin
            Route::get('/dashboard', function($lang = 'es') {
                App::setLocale($lang);
    
                return view('admin/dashboard');
            })->name('admin.dashboard');
            Route::get('/logout', function($lang = 'es') {
                App::setLocale($lang);
                $adminController = new AdminController();
    
                return $adminController->logout();
            });

            //------------------SPONSORS------------------//
            // ADD
            Route::get('/sponsors/add', function ($lang = 'es') {
                $sponsorController = new SponsorController();
                App::setLocale($lang);
        
                return $sponsorController->showAddForm();
            })->name('admin.sponsors.add');
            Route::post('/sponsors/add', function (Request $request, $lang = 'es') {
                $sponsorController = new SponsorController();
                App::setLocale($lang);
                
                return $sponsorController->store($request);
            })->name('admin.sponsor.store');
            // VIEW
            Route::get('/sponsors', function ($lang = 'es') {
                $sponsorController = new SponsorController();
                App::setLocale($lang);
                return $sponsorController->viewAll();
            })->name('admin.sponsors');
            // EDIT
            Route::get('/sponsors/edit/{_id}', function ($lang = 'es', $_id) {
                $sponsorController = new SponsorController();
                App::setLocale($lang);
        
                return $sponsorController->showEditForm($_id);
            })->name('admin.sponsors.edit');
            Route::post('/sponsors/edit/{_id}', function (Request $request, $lang = 'es', $_id) {
                $sponsorController = new SponsorController();
                App::setLocale($lang);
                
                return $sponsorController->update($request, $_id);
            });

            //------------------INSURANCES------------------//
            // ADD
            Route::get('/insurances/add', function ($lang = 'es') {
                $insuranceController = new InsuranceController();
                App::setLocale($lang);

                return $insuranceController->showAddForm();
            })->name('admin.insurances.add');
            Route::post('/insurances/add', function (Request $request, $lang = 'es') {
                $insuranceController = new InsuranceController();
                App::setLocale($lang);
                
                return $insuranceController->store($request);
            });
            // VIEW
            Route::get('/insurances', function ($lang = 'es') {
                $insuranceController = new InsuranceController();
                App::setLocale($lang);
                return $insuranceController->viewAll();
            })->name('admin.insurances');
            // EDIT
            Route::get('/insurances/edit/{_id}', function ($lang = 'es', $_id) {
                $insuranceController = new InsuranceController();
                App::setLocale($lang);

                return $insuranceController->showEditForm($_id);
            })->name('admin.insurances.edit');
            Route::post('/insurances/edit/{_id}', function (Request $request, $lang = 'es', $_id) {
                $insuranceController = new InsuranceController();
                App::setLocale($lang);
                
                return $insuranceController->update($request, $_id);
            });

            //------------------COMPETITIONS------------------//
            $defaultYear = \App\Helpers\CalcSeason::calculate();
            // ADD
            Route::get('/competitions/add', function ($lang = 'es') {
                App::setLocale($lang);
                return view('admin/addCompetitions');
            })->name('admin.competitions.add');
            Route::post('/competitions/add', function (Request $request, $lang = 'es') {
                $competitionController = new CompetitionController();
                App::setLocale($lang);
                
                return $competitionController->store($request);
            });            
            // VIEW
            Route::get('/competitions/{year?}', function ($lang = 'es', $year = null) use ($defaultYear) {
                if ($year === null) {
                    $year = $defaultYear;
                }

                $competitionController = new CompetitionController();
                App::setLocale($lang);
                return $competitionController->viewAll($year);
            })->name('admin.competitions');
            // EDIT
            Route::get('/competitions/edit/{year?}/{_id}', function ($lang = 'es', $year = null, $_id) use ($defaultYear) {
                if ($year === null) {
                    $year = $defaultYear;
                }

                $competitionController = new CompetitionController();
                App::setLocale($lang);
                return $competitionController->showEditForm($year, $_id);
            })->name('admin.competitions.edit');
            Route::post('/competitions/edit/{year?}/{_id}', function (Request $request, $lang = 'es', $year = null, $_id) use ($defaultYear) {
                if ($year === null) {
                    $year = $defaultYear;
                }
                $competitionController = new CompetitionController();
                App::setLocale($lang);
                return $competitionController->update($request, $year, $_id);
            });
        });
    }); 
    //-----------------ADMIN-END-----------------//
    Route::prefix('/team')->group(function () {

    });
});


// ENDPOINTS      ---   Sobre todo para recuperar JSON desde JavaScript

