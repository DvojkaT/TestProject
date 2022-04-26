<?php

namespace App\Http\Controllers\Api;

use App\Domain\DTO\NameValue;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\NameValueResource;
use App\Services\Abstracts\PositionServiceInterface;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public PositionServiceInterface $service;

    public function __construct(PositionServiceInterface $service)
    {
        $this->service = $service;
    }

    public function selectPositions(SearchRequest $search)
    {
        $positions = $this->service->listPosition($search->input('search'));
        $positions->transform(function($item) {
            return new NameValue($item->name,$item->id);
        });
        return NameValueResource::collection($positions);
    }
}
