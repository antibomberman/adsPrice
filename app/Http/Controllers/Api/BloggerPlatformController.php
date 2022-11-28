<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BloggerPlatformStoreRequest;
use App\Http\Requests\Api\BloggerPlatformUpdateRequest;
use App\Http\Requests\Api\OrderHistoryRequest;
use App\Http\Requests\Api\OrderIndexRequest;
use App\Http\Requests\Api\OrderStoreRequest;
use App\Http\Requests\Api\OrderUpdateRequest;
use App\Http\Resources\BloggerOrderResource;
use App\Http\Resources\BloggerPlatformResource;
use App\Http\Resources\OrderResource;
use App\Models\BloggerOrder;
use App\Models\BloggerPlatform;
use App\Models\Order;
use App\Models\Platform;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class BloggerPlatformController extends Controller
{
    function index()
    {
        $platforms = Auth::user()->bloggerPlatforms;
        return response()->json(BloggerPlatformResource::collection($platforms));
    }
    function store(BloggerPlatformStoreRequest $request)
    {
        $bloggerPlatform = Auth::user()->bloggerPlatforms()->create($request->validated());

        return response()->json(new BloggerPlatformResource($bloggerPlatform));
    }
    function update(BloggerPlatformUpdateRequest $request,BloggerPlatform $bloggerPlatform)
    {
        $bloggerPlatform->update($request->validated());
        return response()->json(new BloggerPlatformResource($bloggerPlatform));
    }
    function delete(BloggerPlatform $bloggerPlatform)
    {
        $bloggerPlatform->delete();

        return response()->json(['message' => 'deleted' ]);
    }
}
