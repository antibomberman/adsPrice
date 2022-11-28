<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TaskStoreRequest;
use App\Http\Requests\Admin\TaskUpdateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

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
    function store(TaskStoreRequest $request)
    {
        $task = new Task();
        $task->user_id = \Auth::id();
        $task->name = $request->get('name');
        $task->status = $request->get('status');
        $task->description = $request->get('description');
        $task->text_1 = $request->get('text_1');
        $task->text_2 = $request->get('text_2');
        $task->price = $request->get('price');
        $task->save();

        return response()->json(new TaskResource($task));
    }
    function show(Task $task)
    {
        return response()->json(new TaskResource($task));
    }
    function update(TaskUpdateRequest $request,Task $task)
    {
        $task->update($request->validated());

        return response()->json(new TaskResource($task));
    }
    function delete(Task $task)
    {
        $task->delete();

        return response()->json(['message' => 'deleted']);
    }

}
