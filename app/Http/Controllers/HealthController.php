<?php

namespace App\Http\Controllers;

class HealthController extends Controller
{
    public function show()
    {
        try {
            // Check database connection
            \Illuminate\Support\Facades\DB::connection()->getPdo();
            return response()->json(['status' => 'ok', 'database' => 'connected'], 200);
        } catch (\Exception $e) {
            // Return 200 OK even if database is down during startup
            return response()->json(['status' => 'ok', 'database' => 'pending', 'error' => $e->getMessage()], 200);
        }
    }
}
