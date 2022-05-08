<?php

namespace App\Http\Controllers;

use App\Models\Compliment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $fields = $request->only([
            'message',
            'receiver_user_id',
        ]);

        $fields['sender_user_id'] = Auth::user()->id;

        $compliment = Compliment::create($fields);

        return response()->json($compliment, 201);
    }
}
