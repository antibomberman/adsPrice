<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OrderHistoryRequest;
use App\Http\Requests\Api\OrderIndexRequest;
use App\Http\Requests\Api\OrderStoreRequest;
use App\Http\Requests\Api\OrderUpdateRequest;
use App\Http\Resources\BloggerOrderResource;
use App\Http\Resources\OrderResource;
use App\Models\BloggerOrder;
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
    function store(OrderStoreRequest $request)
    {
        $order =Auth::user()->orders()->create($request->validated());
        return response()->json(new OrderResource( $order));
    }
    function delete(Order $order)
    {
        $order->delete();
        return response()->json(['message' => 'удалено']);
    }
    function update(OrderUpdateRequest $request,Order $order)
    {
        $order->update($request->validated());
        return response()->json(new OrderResource( $order));
    }
    function history(OrderHistoryRequest $request)
    {
        $orders = Auth::user()->orders()->paginate(25);

        return response()->json(OrderResource::collection($orders));
    }
}
