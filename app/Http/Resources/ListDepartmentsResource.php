<?php

namespace App\Http\Resources;

use App\Models\Department;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Department
 */
class ListDepartmentsResource extends JsonResource
{
    /**
     * Create a new resource instance.
     *
     * @param Department $resource
     * @return void
     */
    public function __construct(Department $resource)
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
          "id" => $this->id,
          "name" => $this->name,
          "worker_count" => $this->workers->count(),
        ];
    }
}
