<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //


    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate the form data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to log the user in
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->remember)) {
            $user = Auth::user();
            if ($user->role === $request->role) {
                if ($user->role === 'customer') {
                    return redirect('/');
                } elseif ($user->role === 'admin') {
                    return redirect('/admin/');
                }
            } else {
                Auth::logout();
                return redirect()->route('login')->withErrors(['email' => 'Role mismatch.']);
            }
        }

        // If unsuccessful, then redirect back to the login with the form data
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email', 'role'));
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
