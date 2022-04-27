<?php

namespace App\Http\Resources;

use App\Domain\DTO\NameValue;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin NameValue
 */
class NameValueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return  [
            "name" => $this->name,
            "value" => $this->value,
        ];
    }
}