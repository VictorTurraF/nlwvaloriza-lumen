<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        $credentials = request()->only(['email', 'password']);

        $foundUser = User::where('email', $credentials['email'])->first();
        if (!$foundUser) {
            return response()->json([
                'message' => 'These credentials do not match our records.'
            ], 400);
        }

        if (!$token = Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'These credentials do not match our records.'
            ], 400);
        }

        return $this->respondWithTokenAndUser($token, $foundUser);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithTokenAndUser($token, $user)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'user' => $user,
        ]);
    }
}
