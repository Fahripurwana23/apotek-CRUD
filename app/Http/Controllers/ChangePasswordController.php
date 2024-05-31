<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function showChangePasswordForm()
    {
        return view('change-password');
    }

    public function updatePassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'current_password' => 'required',
            'new_password' => [
                'required',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[A-Z])(?=.*\d).+$/'
            ],
        ], [
            'new_password.regex' => 'The new password must start with an uppercase letter and contain at least one number.'
        ]);

        $user = Auth::user();

        // Cek apakah kata sandi saat ini cocok
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        // Cek apakah kata sandi baru sama dengan kata sandi lama
        if (Hash::check($request->new_password, $user->password)) {
            return back()->withErrors(['new_password' => 'New password cannot be the same as the current password']);
        }

        // Update kata sandi
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('medicine.home')->with('success', 'Password changed successfully');
    }
}