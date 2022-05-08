<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComplimentController extends Controller
{
    // Require authentication
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Creates new compliment
    public function create(Request $request)
    {
        $compliment = $request->all();

        $compliment['id'] = 1;
        $compliment['created_at'] = '';
        $compliment['updated_at'] = '';


        return response()->json($compliment, 201);
    }
}
