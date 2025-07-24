<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('admin.profile-setting', compact('user'));
    }
    public function editProfile()
    {
        $user = Auth::user();
        return view('user.profile-setting', compact('user'));
    }
    public function updateProfile(Request $request)
    {
        if ($request->form_type === 'personal') {
            $request->validate([
                'first_name' => 'required|string|max:50',
                'last_name' => 'required|string|max:50',
                'email' => ['required', 'email', Rule::unique('users')->ignore(Auth::id())],
                'phone' => 'nullable|string|max:20',
            ]);

            $user = Auth::user();
            $user->name = $request->first_name . ' ' . $request->last_name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->save();

            return redirect()->back()->with('profile_success', 'Profile updated successfully.');
        }

        if ($request->form_type === 'password') {
            $request->validate([
                'current_password' => 'required|string',
                'new_password' => ['required', Password::min(8)->mixedCase()->numbers()->symbols(), 'confirmed'],
            ]);

            $user = Auth::user();
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect']);
            }

            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->back()->with('password_success', 'Password updated successfully.');
        }

        return back();
    }

    public function update(Request $request)
    {
        if ($request->form_type === 'personal') {
            $request->validate([
                'first_name' => 'required|string|max:50',
                'last_name' => 'required|string|max:50',
                'email' => 'required|email|unique:users,email,' . Auth::id(),
                'phone' => 'nullable|string|max:20',
            ]);

            $user = Auth::user();
            $user->name = $request->first_name . ' ' . $request->last_name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->save();

            return redirect()->back()->with('profile_success', 'Profile updated successfully.');
        }

        if ($request->form_type === 'password') {
            $request->validate([
                'current_password' => 'required|string',
                'new_password' => 'required|string|min:8|confirmed',
            ]);

            $user = Auth::user();
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect']);
            }

            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->back()->with('password_success', 'Password updated successfully.');
        }

        return back();
    }


}
