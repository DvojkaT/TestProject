<?php

namespace App\Services\Abstracts;

use App\Models\Position;
use Illuminate\Support\Collection;

interface PositionServiceInterface
{
    /**
     * @param string|null $search
     * @return Collection&array<Position>
     * @phpstan-return Collection<Position>
     */
    public function listPosition(string $search = null): Collection;
}
