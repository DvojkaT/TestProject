<?php

namespace App\Repositories;

use App\Repositories\Abstracts\RoleRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use TCG\Voyager\Models\Role;

Class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
{
    public function model()
    {
        return Role::class;
    }
}
