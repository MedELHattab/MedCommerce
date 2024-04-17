<?php



namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $form = $request->validated();
        $user = $this->userRepository->findByEmail($form['email']);
       
        if ($user && Hash::check($form['password'], $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();
       

            return redirect('/')->with('success','You logged in succeessfully');
        }

        return back()->onlyInput('email');
    }

    public function register(RegisterRequest $request)
    {
        $form = $request->validated();
        // dd($form);
        // Compare password and password_confirmation
        if ($form['password'] !== $form['password_confirmation']) {
            return redirect()->route('register')->withInput($request->except('password', 'password_confirmation'))
                ->withErrors(['password_confirmation' => 'Password confirmation does not match']);
        }

        $form['password'] = Hash::make($form['password']);

        $user = $this->userRepository->create($form);
        Auth::login($user);

        return redirect('/')->with('success','You registred succeessfully');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => ($status)])
            : back()->withErrors(['email' => ($status)]);
    }

    public function showResetPasswordForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                ])->save();
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', ($status))
            : back()->withErrors(['email' => [($status)]]);
    }
}
