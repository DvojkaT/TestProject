<?php

namespace App\Http\Controllers\Api;

use App\Domain\DTO\AuthObject;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\AuthResource;
use Illuminate\Database\QueryException;
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
        try {
            $user = $this->service->createUser($request->validated());
        } catch (QueryException) {
            abort(409,"Пользователь с такой почтой уже существует");
        }
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

}
