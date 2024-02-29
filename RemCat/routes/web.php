<?php

use Illuminate\Support\Facades\Route;
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

// Pagina inicio
Route::get('/', function () { return view('frontPage'); });
// Pagina login usuario
Route::get('/login', function() { return view('login'); });
// Pagina login admin
Route::get('/admin', function() { return view('admin/loginAdmin'); });
// Listar usuarios prueba
Route::get('/users', [TUserController::class, 'index'])->name('users.index');
