<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = '';
    public function toArray($request)
    {
        return [
            'token' => $this->token,
            'user' => UserResource::make($this->user),
            'password' => $this->password,
        ];
    }
}
