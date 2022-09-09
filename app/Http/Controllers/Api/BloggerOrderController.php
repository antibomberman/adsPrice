<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BloggerOrderStoreRequest;
use App\Http\Requests\Api\BloggerOrderUpdateRequest;
use App\Http\Requests\Api\OrderHistoryRequest;
use App\Http\Resources\BloggerOrderResource;
use App\Models\BloggerOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BloggerOrderController extends Controller
{
    public function index(OrderHistoryRequest $request)
    {
        $orders = Auth::user()
            ->bloggerOrders()
            ->with('order')
            ->paginate(25);

        return response()->json(BloggerOrderResource::collection($orders));
    }

    public function store(BloggerOrderStoreRequest $request)
    {
        $bloggerOrder = Auth::user()->bloggerOrders()->create([
            'order_id' => $request->get('order_id'),
            'count' => $request->get('count'),
            'token' => Str::random(14),
        ]);

        return response()->json(new BloggerOrderResource($bloggerOrder));
    }

    public function show(BloggerOrder $bloggerOrder)
    {
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

        return response()->json(['message' => 'deleted']);
    }

    public function referral(Request $request, $token)
    {
        $bloggerOrder = BloggerOrder::whereToken($token)->firstOrFail();
        $bloggerOrderView = $bloggerOrder->bloggerOrderView()->firstOrCreate(
            [
                'ip' => $request->ip(),
                'agent' => $request->userAgent(),
            ],
            [
                'ip' => $request->ip(),
                'agent' => $request->userAgent(),
            ]
        );
        $bloggerOrderView->increment('blogger_order_views.open_count');

        return redirect()->to($bloggerOrder->order->link);
    }
}
