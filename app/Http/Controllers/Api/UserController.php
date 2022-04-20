<?php

namespace App\Http\Controllers\Api;

use App\Domain\DTO\AuthObject;
use App\Http\Controllers\Controller;
use App\Http\Resources\AuthResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\Abstracts\UserServiceInterface;
use Illuminate\Http\Request;

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
        Auth::login($user);
        $token = $user->createToken('token')->accessToken;
        $auth_object = new AuthObject($token, $user, $user->password);

        return AuthResource::make($auth_object);
    }

}
