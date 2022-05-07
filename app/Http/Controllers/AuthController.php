<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login() {
        $credentials = request(['email', 'password']);

        $foundUser = User::where('email', $credentials['email'])->first();

        return response()->json([
            'token' => '',
            'user' => $foundUser,
        ], 200);
    }
}
