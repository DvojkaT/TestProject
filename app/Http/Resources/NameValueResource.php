<?php

namespace App\Http\Resources;

use App\Domain\DTO\NameValue;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin NameValue
 */
class NameValueResource extends JsonResource
{
    /**
     * Create a new resource instance.
     *
     * @param NameValue $resource
     * @return void
     */
    public function __construct(NameValue $resource)
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
        return  [
            "name" => $this->name,
            "value" => $this->value,
        ];
    }
}
