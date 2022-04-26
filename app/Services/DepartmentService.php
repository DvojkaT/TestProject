<?php

namespace App\Services;

use App\Http\Requests\SearchRequest;
use App\Repositories\Abstracts\DepartmentRepository;
use App\Repositories\Abstracts\UserRepository;
use App\Services\Abstracts\DepartmentServiceInterface;
use Illuminate\Support\Collection;

class DepartmentService implements DepartmentServiceInterface
{
    public DepartmentRepository $department_repository;

    public UserRepository $user_repository;

    public function __construct(DepartmentRepository $department_repository, UserRepository $user_repository)
    {
        $this->department_repository = $department_repository;
        $this->user_repository = $user_repository;
    }

    /**
     * @inheritDoc
     */
    public function listDepartments(string $search = null): Collection
    {
        if(!$search) {
        return $this->department_repository->all();
        }
        else {
            return $this->department_repository->findWhere([
                ['name', 'like', '%' . $search . '%'],
            ]);
        }
    }
}
