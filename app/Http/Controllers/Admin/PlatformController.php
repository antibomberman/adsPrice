<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PlatformStoreRequest;
use App\Http\Requests\Admin\PlatformUpdateRequest;
use App\Http\Requests\Api\OrderHistoryRequest;
use App\Http\Requests\Api\OrderIndexRequest;
use App\Http\Requests\Api\OrderStoreRequest;
use App\Http\Requests\Api\OrderUpdateRequest;
use App\Http\Resources\BloggerOrderResource;
use App\Http\Resources\OrderResource;
use App\Models\BloggerOrder;
use App\Models\Order;
use App\Models\Platform;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class PlatformController extends Controller
{
    function index()
    {
        $platforms = Platform::all();
        return response()->json($platforms);
    }
    function store(PlatformStoreRequest $request)
    {
        $platform = Platform::create($request->validated());

        return response()->json($platform);
    }
    function update(PlatformUpdateRequest $request,Platform $platform)
    {
        $platform->update($request->validated());

        return response()->json($platform);
    }
    function delete(Platform $platform)
    {
        $platform->delete();

        return response()->json(['message' => 'delete']);
    }
}
