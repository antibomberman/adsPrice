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
            'order' => new OrderResource($this->order),
            'count' => $this->count,
            'url' => $this->url,
            'referral_link' => $this->token,
            'created_at' => $this->created_at,
            'view_count' => $this->bloggerOrderView()->count(),
        ];
    }
}
