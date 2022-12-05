<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TaskPerformRequest;
use App\Http\Resources\TaskBloggerResource;
use App\Http\Resources\TaskResource;
use App\Models\Post;
use App\Models\Task;
use App\Models\TaskBlogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    function index(Request $request)
    {

        $posts = Post::query()
            ->latest()
            ->get();


        return response()->json($posts);
    }
    function show(Post $post)
    {
        return response()->json($post);
    }

}
