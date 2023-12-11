<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use HttpResponses;

    // 4|ZzGOES0MfUkpwnOovkHwWzNDqOYB3Cvskp6f65613d6b218f
    public function login(Request $request): JsonResponse
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return $this->response('Authorized', 200, [
                'token' => $request->user()->createToken('user')->plainTextToken,
                'user' => $request->user(),
            ]);
        }

        return $this->errors('Not Authorized', 403);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return $this->response('Token Revoked', 200);
    }

    public function logoutByToken(): JsonResponse
    {
        if (auth('sanctum')->check()) {
            auth()->user()->tokens()->delete();
        }

        return $this->response('Token Revoked', 200);
    }

    public function verify(): JsonResponse
    {
        return $this->response('Check token', 200, ['data' => auth('sanctum')->check(),
        ]);
    }
}
