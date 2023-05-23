<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PasswordResetInitRequest;
use App\Http\Requests\Api\PasswordResetUpdateRequest;
use App\Http\Requests\Api\PasswordResetVerifyRequest;
use App\Models\User;
use App\Services\Sms;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Str;

class PasswordResetController extends Controller
{
    public function init(PasswordResetInitRequest $request): JsonResponse
    {
        $code = rand(1000,9999);
//         $code = 1111;
        Cache::tags('password_reset')->put($code, $request->validated(), now()->addMinutes(4));
        Sms::send($request->get('phone'),"код подтверждения : $code");

        return response()->json(['message' => 'вам отправлен код', 'send' => 'sms']);
    }

    public function verify(PasswordResetVerifyRequest $request): JsonResponse
    {
        $code = $request->get('code');
        if (! Cache::tags('password_reset')->has($code)) {
            return response()->json(['message' => 'Не найден'], 404);
        }
        $cache = Cache::tags('password_reset')->get($code);
        $passwordToken = Str::random(10);

        $user = User::where('phone', $cache['phone'])->firstOrFail();

        Cache::tags('password_reset')->delete($code);
        Cache::tags('password_reset_token')->put($passwordToken, $user->id, now()->addMinutes(10));

        return response()->json(['password_reset_token' => $passwordToken]);
    }

    public function update(PasswordResetUpdateRequest $request): JsonResponse
    {
        $id = Cache::tags('password_reset_token')->get($request->get('password_reset_token'));

        $user = User::findOrFail($id);
        $user->password = $request->get('password');
        $user->save();

        Cache::tags('password_reset')->delete($request->get('password_reset_token'));

        return response()->json(['message' => 'Успешно']);
    }
}
