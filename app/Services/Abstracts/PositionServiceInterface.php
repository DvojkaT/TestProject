<?php

namespace App\Services\Abstracts;

use Illuminate\Support\Collection;

interface PositionServiceInterface
{
    public function listPosition(string $search = null): Collection;
}
