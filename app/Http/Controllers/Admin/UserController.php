<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

    public function index()
    {

    }
    public function update(UserUpdateRequest $request)
    {
        Auth::user()->update($request->validated());

        return response()->json(new UserResource(Auth::user()));
    }
    public function show()
    {

    }
    public function delete()
    {

    }

}
