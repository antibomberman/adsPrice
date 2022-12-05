<?php

namespace App\Http\Resources;

use App\Models\TaskBlogger;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class NotificationResource extends JsonResource
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
            'type' => $this->type,
            'is_read' => $this->is_read,

            'from_user' => $this->fromUser,
            'to_user' => $this->toUser,

            'order' => $this->order,
            'task' => $this->task,
            'title_ru' => $this->title_ru,
            'title_kz' => $this->title_kz,
            'description_ru' => $this->description_ru,
            'description_kz' => $this->description_kz,
        ];
    }
}
