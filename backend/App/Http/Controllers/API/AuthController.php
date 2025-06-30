<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ForgotRequest;
use Illuminate\Http\Request;
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

    public function logout()
    {
        return $this->authRepository->logout();
    }

    public function refresh()
    {
        return $this->authRepository->refresh();
    }

    public function forgot(ForgotRequest $request)
    {
        return $this->authRepository->forgot($request);
    }

    public function reset(Request $request)
    {
        return $this->authRepository->reset($request);
    }

    public function verifyEmail($email, $token)
    {
        return $this->authRepository->verifyEmail($email, $token);
    }
}
