<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TaskPerformRequest;
use App\Http\Resources\TaskBloggerResource;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\TaskBlogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    function index(Request $request)
    {

        $tasks = Task::query()
            ->when($request->has('user_id'),function (){

            })
            ->with('user')
            ->latest()
            ->get();


        return response()->json(TaskResource::collection($tasks));
    }
    function show(Task $task)
    {
        return response()->json(new TaskResource($task));
    }
    function perform(TaskPerformRequest $request)
    {
        $tb = new TaskBlogger();
        $tb->blogger_id  = Auth::id();
        $tb->task_id = $request->get('task_id');
        $tb->link = $request->get('link');
        $tb->save();

        if ($request->has('images'))
        {
            foreach ($request->file('images') as $item) {
                $tb->images()->create(['path' => $item]);
            }
        }


        return response()->json(new TaskBloggerResource($tb));
    }

}
