<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => __('messages.email_required'),
            'email.email' => __('messages.email_invalid'),
            'password.required' => __('messages.password_required'),
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect users based on role
            return match ($user->role) {
                'admin' => redirect()->route('admin.dashboard')->with('success', __('messages.login_successful')),
                'delivery' => redirect()->route('delivery.dashboard')->with('success', __('messages.login_successful')),
                'user' => redirect()->intended(route('user.dashboard'))->with('success', __('messages.login_successful')),
                default => redirect()->route('login')->withErrors(['login_failed' => __('messages.unknown_role')]),
            };
        }

        return back()->withErrors([
            'login_failed' => __('messages.login_failed'),
        ])->withInput();
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|digits:9|unique:users',
            'password' => [
                'required',
                'confirmed',
                Password::min(6)
                    ->letters()
                    ->numbers()
                    ->symbols()
            ],
            'role' => 'required|in:admin,user,delivery',
        ], [
            'name.required' => __('messages.name_required'),
            'name.max' => __('messages.name_max_length'),
            'email.required' => __('messages.email_required'),
            'email.email' => __('messages.email_invalid'),
            'email.unique' => __('messages.email_already_exists'),
            'phone.required' => __('messages.phone_required'),
            'phone.digits' => __('messages.phone_invalid'),
            'phone.unique' => __('messages.phone_already_exists'),
            'password.required' => __('messages.password_required'),
            'password.confirmed' => __('messages.password_confirmation_mismatch'),
            'role.required' => __('messages.role_required'),
            'role.in' => __('messages.role_invalid'),
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        Auth::login($user);

        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard')->with('success', __('messages.registration_successful')),
            'delivery' => redirect()->route('delivery.dashboard')->with('success', __('messages.registration_successful')),
            default => redirect()->route('user.dashboard')->with('success', __('messages.registration_successful')),
        };
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', __('messages.logout_successful'));
    }
}
