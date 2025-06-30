<?php

namespace App\REpositories;

use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ForgotRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;
use App\Models\Livreur;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class AuthRepository  implements AuthRepositoryInterface
{
    public function login(LoginRequest $attributes)
    {
        $user = User::where('email', $attributes->email)->first();

        if (!$user || !Hash::check($attributes->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'data' => [
                'user' => $user,
                'token' => $token
            ]
        ], 200);
    }
    public function register(RegisterRequest $attributes)
    {
        $user = User::create([
            'name' => $attributes->name,
            'email' => $attributes->email,
            'password' => Hash::make($attributes->password),
            'role' => $attributes->role,
            'telephone' => $attributes->telephone,
        ]);
        if ($user->role === 'client') {
            Client::create([
                'id_user' => $user->id,
                'adresseRue' => $attributes->adresseRue ?? null,
                'adresseVille' => $attributes->adresseVille ?? null,
                'adresseCode_postal' => $attributes->adresseCode_postal ?? null,
                'adressePays' => $attributes->adressePays ?? null,
            ]);
        }

        if ($user->role === 'livreur') {
            Livreur::create([
                'id_user' => $user->id,
                'zoneTravail' => $attributes->zoneTravail ?? null,
                'disponible' => true,
            ]);
        }
        $token = JWTAuth::fromUser($user);

        return response()->json([
            'success' => true,
            'message' => 'Registration successful',
            'data' => [
                'user' => $user,
                'token' => $token
            ]
        ], 201);
    }
    public function logout()
    {
        $user = Auth::user();
        if ($user) {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json([
                'success' => true,
                'message' => 'Logout successful'
            ], 200);
        }
    }
    public function refresh() {
          $token = JWTAuth::getToken();
        if ($token) {
            try {
                $newToken = JWTAuth::refresh($token);
                return response()->json([
                    'success' => true,
                    'message' => 'Token refreshed successfully',
                    'data' => [
                        'token' => $newToken
                    ]
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Token refresh failed'
                ], 401);
            }
        }
    }
 public function forgot(ForgotRequest $request)
    {
        try {
            $status = Password::sendResetLink($request->only('email'));

            Log::channel('auth')->info('Password reset requested', [
                'email' => $request->email,
                'status' => $status
            ]);

            return response()->json([
                'success' => $status === Password::RESET_LINK_SENT,
                'message' => __($status),
                'data' => [
                    'email' => $request->email
                ]
            ], $status === Password::RESET_LINK_SENT ? 200 : 400);
        } catch (\Exception $e) {
            Log::error('Password reset request failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to process reset request'
            ], 500);
        }
    }

    public function reset(Request $request)
    {
        try {
            $request->validate([
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|confirmed|min:8',
            ]);

            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->save();

                    JWTAuth::invalidate(JWTAuth::getToken());
                }
            );

            return response()->json([
                'success' => $status === Password::PASSWORD_RESET,
                'message' => __($status),
                'data' => [
                    'email' => $request->email
                ]
            ], $status === Password::PASSWORD_RESET ? 200 : 400);
        } catch (\Exception $e) {
            Log::error('Password reset failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Password reset failed'
            ], 500);
        }
    }
    public function verifyEmail($email, $token) {}
}
