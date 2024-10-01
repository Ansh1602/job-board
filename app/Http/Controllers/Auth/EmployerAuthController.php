<?php

namespace App\Http\Controllers\Auth;

use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class EmployerAuthController extends Controller
{
    // Show registration form
    public function showRegisterForm()
    {
        return view('auth.employer-register');
    }

    // Handle registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employers',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $employer = Employer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('employer')->login($employer);

        return redirect()->route('employer.dashboard');
    }

    // Show login form
    public function showLoginForm()
    {
        return view('auth.employer-login');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('employer')->attempt($request->only('email', 'password'))) {
            return redirect()->route('employer.dashboard');
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::guard('employer')->logout();
        return redirect()->route('employer.login');
    }
}
