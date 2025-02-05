<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'user_name' => 'required|string',
            'user_pass' => 'required|string',
        ]);

        $user = User::where('user_name', $credentials['user_name'])->first();

        if (!$user || !Hash::check($credentials['user_pass'], $user->user_pass)) {
            return back()->withErrors(['error' => 'Invalid credentials']);
        }

        Auth::login($user);
        return redirect()->route('dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
