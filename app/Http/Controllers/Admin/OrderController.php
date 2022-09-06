<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderIndexRequest;
use App\Http\Requests\Admin\OrderUpdateRequest;
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
        ->when($request->has('status_id'),function ($q){
            return $q->where('status_id',\request('status_id'));
        })
        ->paginate(25);

        return response()->json(OrderResource::collection($orders));
    }
    function show(Order $order)
    {
        return response()->json(new OrderResource( $order));
    }
    function update(OrderUpdateRequest $request,Order $order)
    {
        $order->update($request->validated());

        return response()->json(new OrderResource($order));
    }
    function delete(Order $order)
    {
        $order->delete();

        return response()->json(['message' => 'Удалено']);
    }


}
