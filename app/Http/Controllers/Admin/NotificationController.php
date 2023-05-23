<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthLoginRequest;
use App\Http\Requests\Api\AuthRegisterRequest;
use App\Http\Requests\Api\AuthRegisterVerifyRequest;
use App\Http\Requests\Api\NotificationStoreRequest;
use App\Http\Requests\Api\UserUpdateRequest;
use App\Http\Resources\NotificationResource;
use App\Http\Resources\UserResource;
use App\Models\Category;
use App\Models\Notification;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class NotificationController extends Controller
{


    function index()
    {
        $notifications = Notification::whereNull('task_id')
            ->whereNull('order_id')
            ->orderByDesc('id')
            ->get();
        return $notifications;

        return response()->json(NotificationResource::collection($notifications));
    }
    function store(NotificationStoreRequest $request)
    {
        if ($request->has('to_user_id')){
            $notification = Notification::create($request->validated());
        }else{
           $users = User::cursor();

            foreach ($users as $user) {
                $user->notifications()->create($request->validated());
           }
        }

        return response()->json(['message' => 'send']);
    }

    function read()
    {
        Auth::user()->notifications()->where('is_read',0)->update(['is_read' => 1]);
        return response()->json(['message' => 'read']);
    }
    function delete(Notification $notification)
    {
        $notification->delete();

        return response()->json(['message' => 'удалено']);
    }
    function deleteAll(Request $request)
    {
        $notifications = Notification::where('title_ru', $request->get('title_ru'))
                    ->where('description_ru', $request->get('description_ru'))
                    ->delete();

        return response()->json(['message' => 'удалено']);
    }

    function forMe()
    {
        $notifications = Auth::user()->notifications()->latest()->get();

        return response()->json(NotificationResource::collection($notifications));
    }
}
