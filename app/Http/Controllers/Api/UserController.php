<?php

namespace App\Http\Controllers\Api;

use App\Domain\DTO\AuthObject;
use App\Domain\DTO\WorkerFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\EmailRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RestoreConfirmRequest;
use App\Http\Requests\WorkersListRequest;
use App\Http\Resources\AuthResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\WorkerResource;
use App\Http\Resources\WorkersListResource;
use App\Services\Abstracts\UserServiceInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Services\Abstracts\AuthServiceInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public UserServiceInterface $user_service;


    public function __construct(UserServiceInterface $user_service)
    {
        $this->user_service = $user_service;
    }

    public function showUser(): UserResource
    {
        $user = $this->user_service->showUser(Auth::id());

        return UserResource::make($user);
    }

    public function editUser(EditUserRequest $request): UserResource
    {
        $fields = $request->validated();
        $user = $this->user_service->editUser(Auth::id(), $fields);

        return UserResource::make($user);
    }

    public function showWorker($id): WorkerResource
    {
        $worker = $this->user_service->showWorker($id);

        return WorkerResource::make($worker);
    }

    public function listWorkers(WorkersListRequest $request)
    {
        $worker_obj = new WorkerFilter($request->input('query'), $request->input('department_id'), $request->input('position_id'));
        $worker_list = $this->user_service->listWorkers($worker_obj);

        return WorkersListResource::collection($worker_list);
    }
}
