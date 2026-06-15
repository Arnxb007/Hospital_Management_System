<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        $login = $request->login;

        $field = filter_var($login, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        $credentials = [
            $field => $login,
            'password' => $request->password,
            'role' => $request->role,
            'is_active' => true
        ];

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'patient') {

                if (!$user->patient->profile_completed) {
                    return redirect('/patient/profile/step-1');
                }

                return redirect('/patient/dashboard');
            }

            if ($user->role === 'doctor') {
                return redirect('/doctor/dashboard');
            }

            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Invalid email, password or role.'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}