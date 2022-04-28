<?php

namespace App\Http\Resources;

use App\Domain\DTO\AuthObject;
use App\Models\User;
use App\Models\UserToken;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

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

    public static $wrap = '';

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'token' => $this->token,
            'user' => UserResource::make($this->user),
            'password' => $this->password,
        ];
    }
}
