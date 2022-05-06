<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(Request $request){
        $user = $request->all();

        return response()->json($user, 201);
    }
}
