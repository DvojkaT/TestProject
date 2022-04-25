<?php

namespace App\Repositories;

use App\Models\Position;
use App\Repositories\Abstracts\PositionRepository;
use Prettus\Repository\Eloquent\BaseRepository;

class PositionRepositoryEloquent extends BaseRepository implements PositionRepository
{
    public function model()
    {
        return Position::class;
    }
}
