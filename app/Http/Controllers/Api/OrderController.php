<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OrderHistoryRequest;
use App\Http\Requests\Api\OrderIndexRequest;
use App\Http\Requests\Api\OrderStoreRequest;
use App\Http\Requests\Api\OrderUpdateRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(OrderIndexRequest $request)
    {
        $orders = Order::query()
        ->when($request->has('category_id'), function ($q) {
            return $q->where('category_id', \request('category_id'));
        })
        ->paginate(25);

        return response()->json(OrderResource::collection($orders));
    }

    public function show(Order $order)
    {
        return response()->json(new OrderResource($order));
    }

    public function store(OrderStoreRequest $request)
    {
        $order = Auth::user()->orders()->create($request->validated());

        return response()->json(new OrderResource($order));
    }

    public function delete(Order $order)
    {
        $order->delete();

        return response()->json(['message' => 'удалено']);
    }

    public function update(OrderUpdateRequest $request, Order $order)
    {
        $order->update($request->validated());

        return response()->json(new OrderResource($order));
    }

    public function history(OrderHistoryRequest $request)
    {
        $orders = Auth::user()->orders()->paginate(25);

        return response()->json(OrderResource::collection($orders));
    }
}
