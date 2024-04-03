<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// Controladores
use App\Http\Controllers\TUserController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Devuelve todos los sponsors
Route::get('sponsors/fetchAll', [SponsorController::class, 'fetchAllSponsors']);
// Devuelve las colecciones que existen de competiciones
Route::get('competitons/fetchYears', [CompetitionController::class, 'fetchYears']);
// Mira si el email mandado existe
Route::get('matchEmail', [LoginController::class, 'matchEmail']);

// Cambiar entre activo y no activo
Route::post("sponsors/changeIsActive", [SponsorController::class, 'changeIsActive']);
Route::post("insurances/changeIsActive", [InsuranceController::class, 'changeIsActive']);
Route::post("competitions/changeIsActive", [CompetitionController::class, 'changeIsActive']);
// Cambia una competicion entre cancelada t/f
Route::post("competitions/changeIsCancelled", [CompetitionController::class, 'changeIsCancelled']);