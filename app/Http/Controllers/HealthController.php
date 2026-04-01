<?php

namespace App\Http\Controllers;

class HealthController extends Controller
{
    public function show()
    {
        return response()->json(['status' => 'ok'], 200);
    }
}
