<?php

namespace App\Services\Abstracts;

use Illuminate\Support\Collection;

interface PositionServiceInterface
{
    /**
     * @param string|null $search
     * @return Collection
     */
    public function listPosition(string $search = null): Collection;
}
