<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(Request $request){
        $user = $request->all();

        $user['id'] = rand(1, 100);
        $user['created_at'] = date('Y-m-d H:i:s');
        $user['updated_at'] = date('Y-m-d H:i:s');

        return response()->json($user, 201);
    }
}