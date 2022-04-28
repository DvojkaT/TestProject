<?php

namespace App\Http\Controllers\Api;

use App\Domain\DTO\AuthObject;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmailRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\RestoreConfirmRequest;
use App\Http\Resources\AuthResource;
use App\Services\Abstracts\AuthServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public AuthServiceInterface $auth_service;

    public function __construct(AuthServiceInterface $auth_service)
    {
        $this->auth_service = $auth_service;
    }

    public function store(RegisterRequest $request)
    {
        $attributes = $request->validated();
        $password = Str::random(10);
        $attributes['password'] = $password;

        $user = $this->auth_service->createUser($attributes);
        Auth::login($user);
        $token = $user->createToken('token')->accessToken;

        $auth_object = new AuthObject($token, $user, $password);

        return AuthResource::make($auth_object);
    }

    public function authenticate(LoginRequest $request)
    {
        $auth_object = $this->auth_service->auth($request->input('email'), $request->input('password'));
        return AuthResource::make($auth_object);
    }

    public function restorePassword(EmailRequest $email)
    {
        $token = Str::uuid()->toString();
        $this->auth_service->restorePassword($email->input('email'), $token);

        return new Response('', 201);
    }

    public function restoreConfirmPassword(RestoreConfirmRequest $request)
    {
        $this->auth_service->restoreConfirmPassword($request->input('token'), $request->input("password"));

        return new Response('', 201);
    }
}
