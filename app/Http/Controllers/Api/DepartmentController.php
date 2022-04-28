<?php

namespace App\Http\Controllers\Api;

use App\Domain\DTO\NameValue;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\NameValueResource;
use App\Services\Abstracts\DepartmentServiceInterface;
use App\Http\Resources\ListDepartmentsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public DepartmentServiceInterface $department_service;

    public function __construct(DepartmentServiceInterface $department_service)
    {
        $this->department_service = $department_service;
    }

    public function listDepartments()
    {
        $user_id = Auth::id();
        $departments = $this->department_service->listDepartments($user_id);
        return ListDepartmentsResource::collection($departments);
    }

    public function selectDepartments(SearchRequest $search)
    {
        $departments = $this->department_service->listDepartments(null, $search->input('search'));

        $departments->transform(function ($item) {
            return new NameValue($item->name, $item->id);
        });

        return NameValueResource::collection($departments);
    }
}
