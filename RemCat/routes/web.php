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

Route::get('/', function () {
    return view('frontPage');
});
Route::get('/users', [TUserController::class, 'index'])->name('users.index');
Route::get('/admin', function() {
    return view('admin/loginAdmin');
});