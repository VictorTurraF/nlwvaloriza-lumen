<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = $request->all();

        $craetedUser = User::create($user);

        return response()->json($craetedUser, 201);
    }
}
