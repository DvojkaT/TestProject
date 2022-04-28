<?php

namespace App\Http\Resources;

use App\Domain\DTO\AuthObject;
use App\Models\User;
use App\Models\UserToken;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin AuthObject
 */
class AuthResource extends JsonResource
{
    /**
     * Create a new resource instance.
     *
     * @param AuthObject $resource
     * @return void
     */
    public function __construct(AuthObject $resource)
    {
        parent::__construct($resource);
    }

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
