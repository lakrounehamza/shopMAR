<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\AuthRepository;

class AuthController extends Controller
{
    private AuthRepository $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(LoginRequest $request)
    {
        return $this->authRepository->login($request); 
    }

    public function register(RegisterRequest $request)
    {
        return $this->authRepository->register($request);
              
    }
}