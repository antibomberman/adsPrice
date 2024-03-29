<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BloggerOrderResource extends JsonResource
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
//            'order' => new OrderResource($this->order),
            'user' => $this->user,
            'count' => $this->count,
            'video_view_count' => $this->video_view_count,
            'url' => $this->url,
            'referral_link' => $this->token,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'view_count' => $this->bloggerOrderView()->count(),
        ];
    }
}
