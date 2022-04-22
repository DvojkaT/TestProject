<?php

namespace App\Http\Controllers\Api;

use App\Domain\DTO\AuthObject;
use App\Exceptions\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmailRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\AuthResource;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Services\Abstracts\UserServiceInterface;
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
        Auth::login($user);
        $token = $user->createToken('token')->accessToken;
        $auth_object = new AuthObject($token, $user, $user->password);

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

    //public function restoreConfirmPassword(RestoreConfirmRequest)
}
