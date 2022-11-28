<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BloggerOrderIndexRequest;
use App\Http\Requests\Admin\BloggerOrderStoreRequest;
use App\Http\Requests\Admin\BloggerOrderUpdateRequest;
use App\Http\Resources\BloggerOrderResource;
use App\Models\BloggerOrder;
use Doctrine\DBAL\Query\QueryBuilder;

class BloggerOrderController extends Controller
{
    public function index(BloggerOrderIndexRequest $request)
    {
        $bloggerOrders = BloggerOrder::query()
            ->join('users','users.id','blogger_orders.user_id')
            ->when($request->has('order_id'), function ($q) {
                return $q->where('order_id', \request('order_id'));
            })
            ->when($request->has('user_id'), function ($q) {
                return $q->where('user_id', \request('user_id'));
            })
            ->when($request->has('search'), function (QueryBuilder $q) {
                return $q->where('users.name','LIKE','%'.request('search').'%');
            })
            ->with('order', 'user')
            ->whereHas('order')
            ->select('blogger_orders.*')
            ->get();

        return response()->json(BloggerOrderResource::collection($bloggerOrders));
    }

    public function show(BloggerOrder $bloggerOrder)
    {
        return response()->json(new BloggerOrderResource($bloggerOrder));
    }

    public function store(BloggerOrderStoreRequest $request)
    {
        $bloggerOrder = BloggerOrder::create($request->validated());

        return response()->json(new BloggerOrderResource($bloggerOrder));
    }

    public function update(BloggerOrderUpdateRequest $request, BloggerOrder $bloggerOrder)
    {
        $bloggerOrder->update($request->validated());

        return response()->json(new BloggerOrderResource($bloggerOrder));
    }

    public function delete(BloggerOrder $bloggerOrder)
    {
        $bloggerOrder->delete();

        return response()->json(['message' => 'Удалено']);
    }
}
