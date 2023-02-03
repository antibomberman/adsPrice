<?php

namespace App\Http\Resources;

use App\Models\BloggerOrder;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name_ru' => $this->name_ru,
            'name_kz' => $this->name_kz,
            'user' => $this->user,
            'status' => $this->status,
            'category' => $this->category,

            'count' => $this->count,
            'video_view_count' => $this->video_view_count,
            'view_count' => BloggerOrder::join('blogger_order_views', 'blogger_order_views.blogger_order_id', 'blogger_orders.id')
                ->where('order_id', $this->id)
                ->where('blogger_orders.user_id',\Auth::id())
                ->count(),

            'price' => $this->price,
            'blogger_orders' => BloggerOrderResource::collection($this->bloggerOrders()->with('user')->get()),
            'link' => $this->link,
            'video' => $this->video,
            'video_link' => $this->video_link,
            'description_ru' => $this->description_ru,
            'description_kz' => $this->description_kz,
            'created_at' => $this->created_at,
        ];
    }
}
