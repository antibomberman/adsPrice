<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OrderHistoryRequest;
use App\Http\Requests\Api\OrderIndexRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class OrderController extends Controller
{
    function index(OrderIndexRequest $request)
    {
        $orders = Order::query()
        ->when($request->has('category_id'),function ($q){
            return $q->where('category_id',\request('category_id'));
        })
        ->paginate(25);

        return response()->json(OrderResource::collection($orders));
    }
    function show(Order $order)
    {
        return response()->json(new OrderResource( $order));
    }

    function history(OrderHistoryRequest $request)
    {
        $orders = Auth::user()->orders()->paginate(25);

        return response()->json(OrderResource::collection($orders));
    }
}
