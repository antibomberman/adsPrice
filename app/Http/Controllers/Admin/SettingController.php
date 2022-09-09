<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingUpdateRequest;
use App\Models\BalanceOperation;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{

    function index()
    {
       $setting = Setting::firstOrFail();

        return response()->json($setting);
    }
    function update(SettingUpdateRequest $request)
    {
        $setting = Setting::firstOrFail();
        $setting->update($request->validated());
        return response()->json($setting);
    }
}
