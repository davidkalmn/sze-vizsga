<?php

// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(User $user)
    {
        $posts = $user->posts()->latest()->get();
        return view('posts.index', compact('posts', 'user'));
    }

    public function create(User $user)
    {
        return view('posts.create', compact('user'));
    }

    public function store(Request $request, User $user)
    {
        $request->validate([
            'title' => 'required',
            'summary' => 'required',
            'content' => 'required',
        ]);

        $user->posts()->create($request->all());

        return redirect()->route('home', $user->id);
    }

    public function show(User $user, Post $post)
    {
        $post->load('comments.user');
        return view('posts.show', compact('post', 'user'));
    }

    public function allPosts(User $user = null)
    {
        $posts = Post::with('user')->latest()->get();
        $users = User::all();
        return view('home', compact('posts', 'users', 'user'));
    }

    public function edit(User $user, Post $post)
    {
        return view('posts.edit', compact('post', 'user'));
    }

    public function update(Request $request, User $user, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'summary' => 'required',
            'content' => 'required',
        ]);

        $post->update($request->all());

        return redirect()->route('home', $user->id);
    }

    public function destroy(User $user, Post $post)
    {
        $post->delete();

        return redirect()->route('home', $user->id);
    }
}
