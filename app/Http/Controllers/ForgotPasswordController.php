<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    public function showRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function verifyUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'phone' => 'required|digits:9',
        ], [
            'email.required' => __('messages.email_required'),
            'email.email' => __('messages.email_invalid'),
            'phone.required' => __('messages.phone_required'),
            'phone.digits' => __('messages.phone_invalid'),
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::where('email', $request->email)
                   ->where('phone', $request->phone)
                   ->first();

        if (!$user) {
            return back()->withErrors([
                'user_not_found' => __('messages.user_not_found_with_credentials')
            ])->withInput();
        }

        return redirect()->route('password.reset', ['email' => $user->email])
               ->with('status', __('messages.user_verified_proceed_reset'));
    }

    public function showResetForm($email)
    {
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            return redirect()->route('password.request')
                   ->withErrors(['user_not_found' => __('messages.invalid_reset_link')]);
        }

        return view('auth.reset-password', compact('email'));
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:6',
        ], [
            'email.required' => __('messages.email_required'),
            'email.email' => __('messages.email_invalid'),
            'email.exists' => __('messages.email_not_found'),
            'password.required' => __('messages.password_required'),
            'password.confirmed' => __('messages.password_confirmation_mismatch'),
            'password.min' => __('messages.password_min_length'),
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::where('email', $request->email)->first();
        
        if ($user) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);

            return redirect()->route('login')
                   ->with('status', __('messages.password_reset_successful'));
        }

        return back()->withErrors([
            'email' => __('messages.password_reset_failed')
        ]);
    }
}
