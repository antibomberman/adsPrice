<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BloggerPlatformIndexRequest;
use App\Http\Requests\Admin\BloggerPlatformStoreRequest;
use App\Http\Requests\Admin\BloggerPlatformUpdateRequest;
use App\Http\Resources\BloggerPlatformResource;
use App\Models\BloggerPlatform;

class BloggerPlatformController extends Controller
{
    public function index(BloggerPlatformIndexRequest $request)
    {
        $bloggerPlatforms = BloggerPlatform::query()
            ->when($request->has('user_id'), function ($q) {
                return $q->where('user_id', \request('user_id'));
            })
            ->when($request->has('platform_id'), function ($q) {
                return $q->where('platform_id', \request('platform_id'));
            })
            ->when($request->has('status'), function ($q) {
                return $q->where('status', \request('status'));
            })
            ->latest()
            ->paginate(25);

        return response()->json(BloggerPlatformResource::collection($bloggerPlatforms));
    }

    public function store(BloggerPlatformStoreRequest $request)
    {
        $platform = BloggerPlatform::create($request->validated());

        return response()->json(new BloggerPlatformResource($platform));
    }

    public function update(BloggerPlatformUpdateRequest $request, BloggerPlatform $bloggerPlatform)
    {
        $bloggerPlatform->update($request->validated());

        return response()->json(new BloggerPlatformResource($bloggerPlatform));
    }

    public function delete(BloggerPlatform $bloggerPlatform)
    {
        $bloggerPlatform->delete();

        return response()->json(['message' => 'delete']);
    }
}
