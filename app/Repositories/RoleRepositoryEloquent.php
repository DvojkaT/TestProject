<?php

namespace App\Repositories;

use App\Models\Role;
use App\Repositories\Abstracts\RoleRepository;
use Prettus\Repository\Eloquent\BaseRepository;

Class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
{
    public function model()
    {
        return Role::class;
    }
}
