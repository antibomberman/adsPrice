<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PlatformStoreRequest;
use App\Http\Requests\Admin\PlatformUpdateRequest;
use App\Models\Platform;

class PlatformController extends Controller
{
    public function index()
    {
        $platforms = Platform::all();

        return response()->json($platforms);
    }

    public function store(PlatformStoreRequest $request)
    {
        $platform = Platform::create($request->validated());

        return response()->json($platform);
    }

    public function update(PlatformUpdateRequest $request, Platform $platform)
    {
        $platform->update($request->validated());

        return response()->json($platform);
    }

    public function delete(Platform $platform)
    {
        $platform->delete();

        return response()->json(['message' => 'delete']);
    }
}
