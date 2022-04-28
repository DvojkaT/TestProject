<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin User
 */
class WorkerResource extends JsonResource
{
    /**
     * Create a new resource instance.
     *
     * @param User $resource
     * @return void
     */
    public function __construct(User $resource)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
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
            'worker' => [
                'department' => $this->department->name,
                'position' => $this->position->name,
                'adopted_at' => $this->adopted_at,
            ]
        ];
    }
}
