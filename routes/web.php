<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/login', [AuthController::class,'loginForm'])->name('login')->middleware('guest');
Route::get('/register', [AuthController::class,'registerForm'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class,'register'])->name('newregister')->middleware('guest');
Route::post('/login', [AuthController::class,'login'])->name('newlogin')->middleware('guest');

Route::post('/logout', [AuthController::class,'logout'])->name('logout')->middleware('auth');

Route::get('/dashboard', function () {return view('dashboard');})->middleware('auth');
