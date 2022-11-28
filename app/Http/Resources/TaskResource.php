<?php

namespace App\Http\Resources;

use App\Models\TaskBlogger;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $user = null;
        if ($request->bearerToken()) {
            $token = PersonalAccessToken::findToken($request->bearerToken());
            $user = $token?->tokenable;
        }
        $taskBlogger =  $user ? TaskBlogger::where('task_id',$this->id)
            ->where('blogger_id',$user->id)
            ->latest()
            ->first() : null;

        return [
            'id' => $this->id,
            'user' => $this->user,
            'status' => $this->status,
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'task_blogger' => $taskBlogger ? new TaskBloggerResource($taskBlogger):null,
            'text_1' => $this->text_1,
            'text_2' => $this->text_2,
        ];
    }
}
