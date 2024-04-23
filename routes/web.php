<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavorisController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\MollieController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/auth/callback', function () {
    $githubUser = Socialite::driver('github')->user();
 
    $user = User::updateOrCreate([
        'github_id' => $githubUser->id,
    ], [
        'name' => $githubUser->name,
        'email' => $githubUser->email,
        'github_token' => $githubUser->token,
        'github_refresh_token' => $githubUser->refreshToken,
    ]);
 
    Auth::login($user);
 
    return redirect('welcome');
});

Route::get('/auth/google/redirect', [GoogleController::class , 'handleGoogleRedirect'])->name('google');
Route::get('/auth/google/callback', [GoogleController::class , 'handleGoogleCallback']);



Route::get('/login', [AuthController::class,'loginForm'])->name('login');
Route::get('/register', [AuthController::class,'registerForm'])->name('register');
Route::post('/register', [AuthController::class,'register'])->name('newregister');
Route::post('/login', [AuthController::class,'login'])->name('newlogin');

Route::post('/logout', [AuthController::class,'logout'])->name('logout');

Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::middleware('auth')->group(function () {
Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard')->middleware('isAdmin');

Route::get('/cart', function () {
    return view('cart');
})->name('cart');


Route::post('/addProducttoCart/{id}', [CartController::class, 'addProducttoCart'])->name('addProducttoCart');
Route::post('updateCart/{id}', [CartController::class ,'updateCart'])->name('updateCart');

Route::delete('/deleteFavoris',[FavorisController::class,'deleteFavoris'])->name('deleteFavoris');

Route::get('favoris/',[FavorisController::class, 'index'])->name('favoris');
Route::get('payments/',[MollieController::class,'myPayments'])->name('payment');

Route::get('/categories',[CategoryController::class, 'index'])->name('categories')->middleware('isAdmin');
Route::get('/products',[ProductController::class, 'index'])->name('products')->middleware('isAdmin');
Route::post('/Applycoupon',[CouponController::class ,'Applycoupon'])->name('Applycoupon');
Route::get('/categories/archive',[CategoryController::class, 'archive'])->name('archive')->middleware('isAdmin');
Route::resource("categories", CategoryController::class, [
    'names' => [
        'index' => 'categories'
    ]
])->middleware('isAdmin');
Route::resource("products", ProductController::class, [
    'names' => [
        'index' => 'products'
    ]
])->middleware('isAdmin');

Route::resource("coupons", CouponController::class, [
    'names' => [
        'index' => 'coupons'
    ]
]);
Route::delete('/delete/{id}',[CartController::class,'deleteProduct'])->name('deleteItem');
Route::post('/comments/store',[CommentController::class,'store'])->name('comment.store');
Route::post('/favoris/store',[FavorisController::class,'store'])->name('favoris.store');

// mollie Routes
Route::post('mollie', [MollieController::class, 'mollie'])->name('mollie');
Route::get('success', [MollieController::class, 'success'])->name('success');
Route::get('cancel', [MollieController::class, 'cancel'])->name('cancel');

Route::delete('/comment/destroy/{id}',[CommentController::class,'destroy'])->name('comment.destroy');

});


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
