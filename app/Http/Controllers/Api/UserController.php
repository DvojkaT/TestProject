<?php

namespace App\Http\Controllers\Api;

use App\Domain\DTO\AuthObject;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\AuthResource;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Services\Abstracts\UserServiceInterface;

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

    public function authenticate(LoginRequest $request)
    {
        $auth_object = $this->service->auth($request);
        return AuthResource::make($auth_object);
    }

    public function restorePassword(Request $email)
    {
        return $this->service->restorePassword($email);
    }

}
