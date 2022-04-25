<?php

namespace App\Http\Resources;

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
            'login' => $this->login,
            'name' => $this->name,
            'email' => $this->email,
            'image' => $this->image,
            'about' => $this->about,
            'type' => $this->type,
            'github' => $this->github,
            'city' => $this->city,
            "is_finished" => $this->is_finished,
            'phone' => $this->phone,
            'birthday' => $this->birthday,
            'worker' => [

            ]
        ];
    }
}
