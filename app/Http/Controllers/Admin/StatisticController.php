<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingUpdateRequest;
use App\Models\BalanceOperation;
use App\Models\Order;
use App\Models\Platform;
use App\Models\Setting;
use App\Models\User;

class StatisticController extends Controller
{
    public function index()
    {
        $data['blogger_count'] = User::where('role_id',1)->count();
        $data['customer_count'] = User::where('role_id',2)->count();
        $data['moderator_count'] = User::where('role_id',4)->count();
        $data['balance_operation_plus'] = BalanceOperation::where('operation','plus')->sum('value');
        $data['balance_operation_minus'] = BalanceOperation::where('operation','minus')->sum('value');
        $data['order_count'] = Order::query()->count();
        $data['platforms'] = Platform::withCount('bloggerPlatforms')->get();

        return response()->json($data);
    }

}
