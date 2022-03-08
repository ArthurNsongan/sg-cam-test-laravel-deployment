<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompteController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login_page');

Route::get('/register', function () {
    return view('auth.register');
})->name('register_page');

Route::post('/login', [AuthController::class, 'login'])->name('auth_login');

Route::post('/register', [AuthController::class, 'register'])->name('auth_register');

Route::get('/logout', [AuthController::class, 'logout'])->name('auth_logout');

Route::get('/',[CompteController::class, 'home'] )->middleware('auth')->name('home_page');