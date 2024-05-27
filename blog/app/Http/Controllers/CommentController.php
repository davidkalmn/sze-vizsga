<?php


// app/Http/Controllers/CommentController.php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required',
            'user_id' => 'required|exists:users,id',
        ]);

        $post->comments()->create($request->all());

        return redirect()->route('home');
    }
}
