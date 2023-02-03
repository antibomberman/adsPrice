<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserIndexRequest;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index(UserIndexRequest $request)
    {
        $users = User::query()
            ->when($request->has('search'),function ($q){
                return $q->where('name','LIKE','%'.\request('search').'%');
            })
            ->when($request->has('category_id'),function ($q){
                return $q->where('category_id',\request('category_id'));
            })
            ->when($request->has('role_id'),function ($q){
                return $q->where('role_id',\request('role_id'));
            })
            ->when($request->has('manager_id'),function ($q){
                return $q->where('manager_id',\request('manager_id'));
            })
            ->latest('users.id')
            ->get();

        return response()->json(UserResource::collection($users));
    }
    public function store(UserStoreRequest $request)
    {
       $user = User::create($request->validated());

        return response()->json(new UserResource($user));
    }
    public function update(UserUpdateRequest $request,User $user)
    {
        $uniquePhone = User::where('phone', $request['phone'])->where('id', '!=', $user['id'])->first();
        if ($uniquePhone) {
            return response()->json(['message' => 'Данный номер телефона занят'],400);
        }
        $user->update($request->validated());

        return response()->json(new UserResource($user));
    }
    public function show(User $user)
    {
        return response()->json(new UserResource($user));
    }
    public function delete(User $user)
    {
        $user->delete();

        return response()->json(['message' => 'удалено']);
    }

}
