<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderIndexRequest;
use App\Http\Requests\Admin\OrderStoreRequest;
use App\Http\Requests\Admin\OrderUpdateRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Doctrine\DBAL\Query\QueryBuilder;

class OrderController extends Controller
{
    public function index(OrderIndexRequest $request)
    {
        $orders = Order::query()
            ->join('users','users.id','orders.user_id')
            ->when($request->has('category_id'), function ($q) {
                return $q->where('category_id', \request('category_id'));
            })
            ->when($request->has('user_id'), function ($q) {
                return $q->where('user_id', \request('user_id'));
            })
            ->when($request->has('search'), function (QueryBuilder $q) {
                return $q->where(function (QueryBuilder $qq){
                    return $qq->where('users.name','LIKE','%'.request('search').'%')
                    ->orWhere('orders.name','LIKE','%'.request('search').'%')
                    ->orWhere('orders.description','LIKE','%'.request('search').'%');
                });
            })
            ->when($request->has('status_id'), function ($q) {
                return $q->where('status_id', \request('status_id'));
            })
            ->select('orders.*')
            ->paginate(25);

        return response()->json(OrderResource::collection($orders));
    }

    public function show(Order $order)
    {
        return response()->json(new OrderResource($order));
    }

    public function store(OrderStoreRequest $request)
    {
        $order = Order::create($request->validated());

        return response()->json(new OrderResource($order));
    }

    public function update(OrderUpdateRequest $request, Order $order)
    {
        $order->update($request->validated());

        return response()->json(new OrderResource($order));
    }

    public function delete(Order $order)
    {
        $order->delete();

        return response()->json(['message' => 'Удалено']);
    }
}
