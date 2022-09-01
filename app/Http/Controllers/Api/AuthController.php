<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthLoginRequest;
use App\Http\Requests\Api\AuthRegisterRequest;
use App\Http\Requests\Api\AuthRegisterVerifyRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(AuthRegisterRequest $request) : JsonResponse
    {

//        $code = rand(1000,9999);
        $code = 1111;
        Cache::tags('register')->put($code,$request->validated(),now()->addMinutes(2));
        return response()->json(['message' => 'вам отправлен код','send' => 'sms']);
    }

    public function registerVerify(AuthRegisterVerifyRequest $request): JsonResponse
    {
        $code = $request->get('code');
        if (!Cache::tags('register')->has($code)){
            return  response()->json(['message' => 'Не найден'],404);
        }

        $data = Cache::tags('register')->get($code);
        $user = User::create($data);

        $token = $user->createToken('auth_token')->plainTextToken;


        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => new UserResource($user)
        ]);
    }

    public function login(AuthLoginRequest $request):JsonResponse
    {

        $user = User::where('phone',$request->get('phone'))->firstOrFail();

        if (!Hash::check($request->get('password'),$user->password)) {
            return response()->json([
                'message' => 'неверный пароль'
            ], 400);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => new UserResource($user),
        ]);
    }


    public function logout():JsonResponse
    {
        Auth::user()->tokens()->delete();

        return response()->json(['message' => 'вы вышли']);
    }

}
