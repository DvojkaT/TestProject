<?php

namespace App\Http\Controllers\Api;

use App\Domain\DTO\AuthObject;
use App\Domain\DTO\WorkerFilter;
use App\Exceptions\UserAlreadyExistsHttpException;
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
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Services\Abstracts\UserServiceInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public UserServiceInterface $service;

    public function __construct(UserServiceInterface $service)
    {
        $this->service = $service;
    }

    public function store(RegisterRequest $request)
    {
        $user = $this->service->createUser($request->validated());
        $password = Str::random(10);
        $user->password = Hash::make($password);
        $user->save();
        Auth::login($user);
        $token = $user->createToken('token')->accessToken;
        $auth_object = new AuthObject($token, $user, $password);

        return AuthResource::make($auth_object);
    }

    public function authenticate(LoginRequest $request)
    {
        $auth_object = $this->service->auth($request->input('email'), $request->input('password'));
        return AuthResource::make($auth_object);
    }

    public function restorePassword(EmailRequest $email)
    {
        $token = Str::uuid()->toString();
        $this->service->restorePassword($email->input('email'), $token);

        return new Response('', 201);
    }

    public function restoreConfirmPassword(RestoreConfirmRequest $request)
    {
        $this->service->restoreConfirmPassword($request->input('token'), $request->input("password"));

        return new Response('', 201);
    }

    public function showUser(): UserResource
    {
        $user = $this->service->showUser(Auth::id());

        return UserResource::make($user);
    }

    public function editUser(EditUserRequest $request): UserResource
    {
        $fields = $request->validated();
        $user = $this->service->editUser(Auth::id(), $fields);

        return UserResource::make($user);
    }

    public function showWorker($id): WorkerResource
    {
        $worker = $this->service->showWorker($id);

        return WorkerResource::make($worker);
    }

    public function listWorkers(WorkersListRequest $request)
    {
        $worker_obj = new WorkerFilter($request->input('query'), $request->input('department_id'), $request->input('position_id'));
        $worker_list = $this->service->listWorkers($worker_obj);

        return WorkersListResource::collection($worker_list);
    }
}
