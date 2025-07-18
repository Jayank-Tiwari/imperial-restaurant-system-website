<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect users based on role
            return match ($user->role) {
                'admin' => redirect()->route('admin.dashboard'),
                'delivery' => redirect()->route('delivery.dashboard'),
                'user' => redirect()->intended(route('user.dashboard')), // Only 'user' gets intended redirect
                default => redirect()->route('login')->withErrors(['email' => 'Unknown role.']),
            };
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->onlyInput('email');
    }


    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|digits:10',
            'password' => [
                'required',
                'confirmed',
                Password::min(6)
                    ->letters()
                    ->numbers()
                    ->symbols()
            ],
            'role' => 'required|in:admin,user,delivery',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        Auth::login($user);

        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'delivery' => redirect()->route('delivery.dashboard'),
            default => redirect()->route('user.dashboard'),
        };
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
