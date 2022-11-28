<?php

namespace App\Http\Resources;

use App\Models\TaskBlogger;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class TaskBloggerResource extends JsonResource
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
            'task_id' => $this->task_id,
            'blogger' => $this->blogger,
            'status' => $this->status,
            'link' => $this->link,
            'message' => $this->message,
            'images' => $this->images,
        ];
    }
}
