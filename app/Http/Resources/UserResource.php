<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'phone' => $this->phone,
            'description_ru' => $this->description_ru,
            'description_kz' => $this->description_kz,
            'avatar' => $this->avatar,
            'balance' => $this->balance,
            'category' => $this->category,
            'status' => $this->status,
            'role' => $this->role,
            'is_agree' => $this->is_agree,
            'show_tasks' => $this->show_tasks,
            'manager' => User::find($this->manager_id),
            'iban' => $this->iban,
            'created_at' => $this->created_at,

        ];
    }
}
