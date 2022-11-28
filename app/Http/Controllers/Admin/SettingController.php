<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingUpdateRequest;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::firstOrFail();

        return response()->json($setting);
    }

    public function update(SettingUpdateRequest $request)
    {
        $setting = Setting::firstOrFail();
        $setting->update($request->validated());
        $setting->save();

        return response()->json($setting);
    }
}
