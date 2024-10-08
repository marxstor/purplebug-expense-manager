<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


class AuthController extends Controller
{
    public function index() {
        if(Auth::check()) {
            return Inertia::render('Dashboard');
        }

        return Inertia::render('auth/Login');
    }
    
    public function loginUser(Request $request) {
        // validate data
        $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        // if login fails
        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->onlyInput('email'); // Retain email in input field
    }

    public function logout(Request $request) {
        $request->session()->invalidate();
        // regenerate csrf token
        $request->session()->regenerateToken();
        Auth::logout();

        // Redirect to the login page
        return redirect()->route('login');
    }
}
