<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = $request->all();

        $craetedUser = User::create([
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => (new BcryptHasher)->make($user['password']),
        ]);

        return response()->json($craetedUser, 201);
    }
}
