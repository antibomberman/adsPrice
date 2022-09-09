<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Platform;

class PlatformController extends Controller
{
    public function index()
    {
        $platforms = Platform::all();

        return response()->json($platforms);
    }
}
