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
    function completed(Request $request)
    {
        $lastItem = Task::get()->last();
        $tasks = TaskBlogger::where('task_id', $lastItem->id)
            ->join('users', 'users.id', 'task_bloggers.blogger_id')
            ->where('task_bloggers.status', 2)
            ->select('users.*', 'task_bloggers.paid', 'task_bloggers.id as task_blogger_id')
            ->get();


        return response()->json($tasks);
    }

}
