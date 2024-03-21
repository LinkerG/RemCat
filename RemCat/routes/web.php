<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Helpers\CalcSeason;
use Illuminate\Support\Facades\URL;
// Controladores 
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;

$defaultYear = CalcSeason::calculate();

// RUTAS DE LA WEB
// Definición de idioma por defecto
Route::prefix('{lang?}')->where(['lang' => 'en|es|ca'])->group(function () use($defaultYear) {

    // Página de inicio
    Route::get('/', function ($lang = 'es') {
        $year = CalcSeason::calculate();
        $competitionController = new CompetitionController();

        App::setLocale($lang);
        return $competitionController->showFrontPage($year);
    })->name('home');

    // Página de inicio de sesión de usuario y equipos
    Route::get('/login', function ($lang = 'es') {
        App::setLocale($lang);
        return view('login');
    })->name('login');
    //POST PARA USUARIOS
    Route::post('/userLogin',function($lang = 'es') {
        App::setLocale($lang);
        $userController = new UserController();
        return $userController->auth();
    });
    //POST PARA EQUIPO
    Route::post('/teamLogin',function($lang = 'es') {
        App::setLocale($lang);

        $teamController = new TeamController();
        return $teamController->auth();
    });
    //------------------ADMIN------------------//
    $defaultYear = CalcSeason::calculate();
    Route::prefix('/admin')->group(function() use ($defaultYear){
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
                
                $logoUrl = URL::asset('images/logo-white-sin-texto.png');

                return view('admin/dashboard', [
                    'logoUrl' => $logoUrl
                ]);
            })->name('admin.dashboard');

            //Logout
            Route::get('/logout', function($lang = 'es') {
                App::setLocale($lang);
                $adminController = new AdminController();
    
                return $adminController->logout();
            })->name('admin.logout');

            //------------------SPONSORS------------------//
            // VIEW
            Route::get('/sponsors', function ($lang = 'es') {
                $sponsorController = new SponsorController();
                App::setLocale($lang);
                return $sponsorController->viewAll();
            })->name('admin.sponsors');
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
            // VIEW
            Route::get('/insurances', function ($lang = 'es') {
                $insuranceController = new InsuranceController();
                App::setLocale($lang);
                return $insuranceController->viewAll();
            })->name('admin.insurances');
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
            $defaultYear = CalcSeason::calculate();
            // VIEW
            Route::get('/competitions/{year?}', function ($lang = 'es', $year = null) use ($defaultYear) {
                if ($year === null) {
                    $year = $defaultYear;
                }

                $competitionController = new CompetitionController();
                App::setLocale($lang);
                return $competitionController->viewAll($year);
            })->name('admin.competitions');
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
            // EDIT
            Route::get('/competitions/edit/{year?}/{_id}', function ($lang = 'es', $year = null, $_id)  use ($defaultYear) {
                if ($year === null) {
                    $year = $defaultYear;
                }

                $competitionController = new CompetitionController();
                App::setLocale($lang);
                return $competitionController->showEditForm($year, $_id);
            })->name('admin.competitions.edit');

            Route::post('/competitions/edit/{year?}/{_id}', function (Request $request, $lang = 'es', $year = null, $_id)  use ($defaultYear)  {
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

    //-----------------TEAMS-----------------//
    Route::prefix('/team')->group(function() use ($defaultYear) {
        //REGISTRO DE EQUIPOS
        Route::post('/register', function (Request $request, $lang = 'es') {
            $teamController = new TeamController();
            App::setLocale($lang);
                    
            return $teamController->store($request);
        });
        //MIDDLEWARE PARA EQUIPOS
        Route::middleware(['team.auth'])->group(function () {
            //Logout
            Route::get('/logout', function($lang = 'es') {
                App::setLocale($lang);
                $teamController = new TeamController();
    
                return $teamController->logout();
            })->name('team.logout');

            Route::get('/frontPage', function($lang = 'es') {
                App::setLocale($lang);

                return view('teams/teamIndex');
            })->name('team.frontPage');
        });
    });
    //-----------------TEAMS-END--------------------//

    //-----------------USERS---------------------//
    Route::prefix('/user')->group(function() use ($defaultYear) {
        Route::post('/register', function (Request $request, $lang = 'es') {
            $userController = new UserController();
            App::setLocale($lang);
                    
            return $userController->store($request);
        });
        //MIDDLEWARE PARA USUARIOS
        Route::middleware(['user.auth'])->group(function() {
            //LOGOUT
            Route::get('/logout', function($lang = 'es') {
                App::setLocale($lang);
                $userController = new UserController();
    
                return $userController->logout();
            })->name('user.logout');

            Route::get('/frontPage', function($lang = 'es') {
                App::setLocale($lang);

                return view('users/userIndex');
            })->name('user.frontPage');
        });
    });
    //-----------------USERS-END-----------------//
});
