<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AuthLoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(AuthLoginRequest $request):JsonResponse
    {

        $user = User::where('phone',$request->get('phone'))->first();

        if (!$user){
            return  response()->json([
                'message' => 'неверный телефон номер'
            ],400);
        }

        if (!Hash::check($request->get('password'),$user->password)) {
            return response()->json([
                'message' => 'неверный пароль'
            ], 400);
        }
        if ($user->isAdmin() or $user->isModerator()){
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => new UserResource($user),
            ]);
        }else{
            return response()->json([
                'message' => 'нет доступа'
            ], 400);
        }


    }
    public function logout():JsonResponse
    {
        Auth::user()->tokens()->delete();

        return response()->json(['message' => 'вы вышли']);
    }
    public function profile(){
        return response()->json(new UserResource(Auth::user()));
    }

}
