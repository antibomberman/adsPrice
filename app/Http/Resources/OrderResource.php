<?php

namespace App\Http\Resources;

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
            'name' => $this->name,
            'user' => $this->user,
            'status' => $this->status,
            'category' => $this->category,
            'count' => $this->count,
            'view_count' => $this->getViewCount(),
            'price' => $this->price,
            'link' => $this->link,
            'video' => $this->video,
            'description' => $this->description,
            'created_at' => $this->created_at,
        ];
    }
}
