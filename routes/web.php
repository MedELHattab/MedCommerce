<?php

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
Route::get('/register', function () {
    return view('register');
});

// Route::get('/login', [AuthController::class,'loginForm'])->name('login')->middleware('guest');
// Route::get('/register', [AuthController::class,'index'])->name('register')->middleware('guest');
// Route::get('/dashboard', [AuthController::class,'dashboard'])->name('dashboard')->middleware('auth');
// Route::post('/register/store', [AuthController::class,'register'])->name('newregister')->middleware('guest');


