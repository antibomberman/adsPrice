<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PlatformStoreRequest;
use App\Http\Requests\Admin\PlatformUpdateRequest;
use App\Http\Requests\Admin\PostStoreRequest;
use App\Http\Requests\Admin\PostUploadImageRequest;
use App\Http\Requests\Api\OrderHistoryRequest;
use App\Http\Requests\Api\OrderIndexRequest;
use App\Http\Requests\Api\OrderStoreRequest;
use App\Http\Requests\Api\OrderUpdateRequest;
use App\Http\Resources\BloggerOrderResource;
use App\Http\Resources\OrderResource;
use App\Models\BloggerOrder;
use App\Models\Order;
use App\Models\Platform;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    function index()
    {
        $posts = Post::latest()->get();
        return response()->json($posts);
    }
    function store(PostStoreRequest $request)
    {
        $post = Auth::user()->posts()->create($request->validated());

        return response()->json($post);
    }
    function update(PostStoreRequest $request,Post $post)
    {
        $post->update($request->validated());

        return response()->json($post);
    }
    function delete(Post $post)
    {
        $post->delete();

        return response()->json(['message' => 'delete']);
    }
    public function uploadImage(PostUploadImageRequest $request)
    {
        $fileName = Storage::disk('public')->putFile('images/'.Carbon::now()->format('Y/m'), $request->file('image'));

        return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => Storage::disk('public')->url($fileName)]);
    }
}
