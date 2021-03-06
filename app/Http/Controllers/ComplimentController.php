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

    public function index()
    {
        $compliments = Compliment::all();

        return response()->json($compliments);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'message' => 'required|string|max:255',
            'receiver_user_id' => 'required|exists:users,id',
        ]);

        $fields = $request->only([
            'message',
            'receiver_user_id'
        ]);

        if (Auth::user()->id === $fields['receiver_user_id']) {
            return response()->json([
                'message' => 'You cannot send a compliment to yourself.',
            ], 400);
        }

        $fields['sender_user_id'] = Auth::user()->id;

        $compliment = Compliment::create($fields);
        $compliment->tags()->attach($request->input('tags', []));

        $compliment['tags'] = $compliment->tags;

        return response()->json($compliment, 201);
    }

    public function received()
    {
        $compliments = Compliment::where('receiver_user_id', Auth::user()->id)->get();

        return response()->json($compliments);
    }

    public function sent()
    {
        $compliments = Compliment::where('sender_user_id', Auth::user()->id)->get();

        return response()->json($compliments);
    }
}
