<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth/login');
    }

    public function authenticate(LoginRequest $request)
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {

            // $request->session()->regenerate();
 
            return redirect()->route('dashboards.index');
        }
 
        return back()->withErrors([
            'invalid-credentials' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // $request->session()->invalidate();

        return redirect()->route('login');
    }
}
