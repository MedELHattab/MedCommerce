<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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

Route::get('/login', [AuthController::class,'loginForm'])->name('login');
Route::get('/register', [AuthController::class,'registerForm'])->name('register');
Route::post('/register', [AuthController::class,'register'])->name('newregister');
Route::post('/login', [AuthController::class,'login'])->name('newlogin');

Route::post('/logout', [AuthController::class,'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
