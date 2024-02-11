<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function registerForm()
    {
        return view('register');
    }
    public function loginForm()
    {
        return view('login');
    }

    public function login(LoginRequest $request)
    {
       $form = $request->validated();

       if(Auth::attempt($form)){
        $request->session()->regenerate();
        return redirect('/');
       }

       return back()->onlyInput('email');

    }

    public function register(RegisterRequest $request)
    {
       $form = $request->validated();
       $form['password'] = Hash::make($form['password']);

       $user = User::create($form);
       auth()->login($user);
       return redirect('/');

    }

    public function logout(Request $request)
    {
      auth()->logout();
      $request->session()->invalidate();
      $request->session()->regenerateToken();
      return redirect('/');
    }
}