<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\RegisterResource;
use App\Services\Auth\LoginServiceInterface;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function __construct(private LoginServiceInterface $loginService)
    {
    }


    /**
     * @param RegisterRequest $registerRequest
     * @return RegisterResource
     */
    public function register(RegisterRequest $registerRequest)
    {
        $token = $this->loginService->register($registerRequest->validated());

        return new RegisterResource($token);
    }

    public function login(LoginRequest $loginRequest)
    {
        return $this->loginService->login($loginRequest->validated());
    }
}
