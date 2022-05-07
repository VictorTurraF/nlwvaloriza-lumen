<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login() {
        $credentials = request(['email', 'password']);

        $foundUser = User::where('email', $credentials['email'])->first();

        if (!$foundUser) {
            return response()->json([
                'message' => 'These credentials do not match our records.'
            ], 400);
        }

        return response()->json([
            'token' => '',
            'user' => $foundUser,
        ], 200);
    }
}
