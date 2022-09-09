<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserIndexRequest;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    public function index(UserIndexRequest $request)
    {
        $users = User::query()
            ->when($request->has('search'), function ($q) {
                return $q->where('name', 'LIKE', '%'.\request('search').'%');
            })
            ->when($request->has('category_id'), function ($q) {
                return $q->where('category_id', \request('category_id'));
            })
            ->when($request->has('role_id'), function ($q) {
                return $q->where('role_id', \request('role_id'));
            })
            ->latest('users.id')
            ->paginate(25);

        return response()->json(UserResource::collection($users));
    }

    public function store(UserStoreRequest $request)
    {
        $user = User::create($request->validated());

        return response()->json(new UserResource($user));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
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
