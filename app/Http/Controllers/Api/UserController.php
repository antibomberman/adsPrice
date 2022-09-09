<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        return response()->json(new UserResource(Auth::user()));
    }

    public function update(UserUpdateRequest $request)
    {
        Auth::user()->update($request->validated());

        return response()->json(new UserResource(Auth::user()));
    }

    public function category()
    {
        return response()->json(Category::orderBy('name')->get());
    }

    public function setting()
    {
        return response()->json(Setting::firstOrFail());
    }

    public function notification()
    {
        $notifications = Auth::user()->notifications()->latest()->get();

        return response()->json($notifications);
    }
}
