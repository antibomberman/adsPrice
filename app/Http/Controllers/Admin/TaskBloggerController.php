<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TaskBloggerUpdateRequest;
use App\Http\Requests\Admin\TaskUpdateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\TaskBlogger;
use Illuminate\Http\Request;

class TaskBloggerController extends Controller
{

    function index(Request $request)
    {

        $tasks = TaskBlogger::query()
            ->when($request->has('blogger_id'),function ($q){
                    return $q->where('blogger_id',\request('blogger_id'));
            })
            ->when($request->has('task_id'),function ($q){
                    return $q->where('task_id',\request('task_id'));
            })
            ->when($request->has('status'),function ($q){
                    return $q->where('status',\request('status'));
            })
            ->with(['blogger','task', 'images'])
            ->get();


        return response()->json($tasks);
    }
    function update(TaskBloggerUpdateRequest $request,TaskBlogger $taskBlogger)
    {
        $taskBlogger->update($request->validated());

        return response()->json($taskBlogger);
    }
    function delete(TaskBlogger $taskBlogger)
    {
        $taskBlogger->delete();

        return response()->json(['message' => 'deleted']);
    }

}
