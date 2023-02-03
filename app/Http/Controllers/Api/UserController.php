<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthLoginRequest;
use App\Http\Requests\Api\AuthRegisterRequest;
use App\Http\Requests\Api\EditPasswordRequest;
use App\Http\Requests\Api\AuthRegisterVerifyRequest;
use App\Http\Requests\Api\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\Category;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

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

    function category()
    {
        return response()->json(Category::orderBy('name_ru')->get());
    }
    function setting()
    {
        return response()->json(Setting::firstOrFail());
    }
    function editPassword(EditPasswordRequest $request)
    {
        $user = auth()->user()->makeVisible(['password']);
//         dd(Hash::make($request['new_password']), $user->password, $request['old_password']);
        if (!Hash::check($request->get('old_password'), $user->password)) {
            return response()->json([
                'message' => 'неверный пароль'
            ], 400);
        }

        $user['password'] = Hash::make($request['new_password']);

        $user->save();


        return response()->json(['message' => 'Успешно']);
    }

}
