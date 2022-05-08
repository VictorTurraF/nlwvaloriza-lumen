<?php

namespace App\Http\Controllers;

use App\Models\Compliment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplimentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'message' => 'required|string|max:255',
            'receiver_user_id' => 'required|exists:users,id',
        ]);

        $fields = $request->only([
            'message',
            'receiver_user_id',
        ]);

        $fields['sender_user_id'] = Auth::user()->id;

        $compliment = Compliment::create($fields);

        return response()->json($compliment, 201);
    }
}
