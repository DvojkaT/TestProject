<?php

namespace App\Repositories;


use App\Models\Department;
use App\Repositories\Abstracts\DepartmentRepository;
use Prettus\Repository\Eloquent\BaseRepository;

class DepartmentRepositoryEloquent extends BaseRepository implements DepartmentRepository
{
    public function model()
    {
        return department::class;
    }
}
