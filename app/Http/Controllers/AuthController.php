<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->is_admin) {
                return redirect()->route('dashboard.index');
            } else {
                Auth::logout();
                return redirect('/login')->withErrors([
                    'email' => 'You are not authorized to access the dashboard.',
                ]);
            }
        }
        return view('login.index');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->is_admin) {
                return redirect()->intended(route('dashboard.index'))->with('success', 'Login successful');
            } else {
                Auth::logout();
                return redirect('/login')->withErrors([
                    'email' => 'You are not authorized to access the dashboard.',
                ]);
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('webpages.home')->with('success', 'Logout successful');
    }
}
