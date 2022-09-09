<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BloggerPlatformStoreRequest;
use App\Http\Requests\Api\BloggerPlatformUpdateRequest;
use App\Http\Resources\BloggerPlatformResource;
use App\Models\BloggerPlatform;
use Illuminate\Support\Facades\Auth;

class BloggerPlatformController extends Controller
{
    public function index()
    {
        $platforms = Auth::user()->bloggerPlatforms;

        return response()->json(BloggerPlatformResource::collection($platforms));
    }

    public function store(BloggerPlatformStoreRequest $request)
    {
        $bloggerPlatform = Auth::user()->bloggerPlatforms()->create($request->validated());

        return response()->json(new BloggerPlatformResource($bloggerPlatform));
    }

    public function update(BloggerPlatformUpdateRequest $request, BloggerPlatform $bloggerPlatform)
    {
        $bloggerPlatform->update($request->validated());

        return response()->json(new BloggerPlatformResource($bloggerPlatform));
    }

    public function delete(BloggerPlatform $bloggerPlatform)
    {
        $bloggerPlatform->delete();

        return response()->json(['message' => 'deleted']);
    }
}
