<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function showRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function verifyUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'phone' => 'required'
        ]);

        $user = User::where('email', $request->email)
            ->where('phone', $request->phone)
            ->first();

        if ($user) {
            // Redirect to password reset form with email
            return redirect()->route('password.reset', ['email' => $user->email]);
        }

        return back()->withErrors(['email' => 'Email and phone number do not match our records.']);
    }

    public function showResetForm($email)
    {
        return view('auth.reset-password', compact('email'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('success', 'Password reset successfully. Please login.');
    }
}
