<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        if (auth()->attempt($data)) {
            if (!auth()->user()->hasVerifiedEmail()) {
                auth()->logout();
                return back()->with('error', 'You need to verify your email address before logging in.');
            }
            return redirect()->route('notes.index')->with('success', 'You have been logged in!');
        }
        return back()->with('error', 'Invalid credentials');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'You have been logged out!');
    }
}