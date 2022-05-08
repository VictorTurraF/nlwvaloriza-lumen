<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:tags'
        ]);

        $fields = $request->only([
            'name',
            'color'
        ]);

        $createdTag = Tag::create($fields);

        return response()->json($createdTag, 201);
    }
}
