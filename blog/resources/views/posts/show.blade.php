@extends('layouts.app')

@section('content')
<h1>{{ $post->title }}</h1>
<p>{{ $post->summary }}</p>
<p>{{ $post->content }}</p>
<p>Author: {{ $user->username }}</p>
<p>Created at: {{ $post->created_at }}</p>

<h2>Comments</h2>
<ul>
    @foreach($post->comments as $comment)
    <li>
        <strong>{{ $comment->user->username }}:</strong> {{ $comment->content }}
    </li>
    @endforeach
</ul>

<h2>Add a Comment</h2>
<form method="POST" action="{{ route('posts.comments.store', $post) }}">
    @csrf
    <input type="hidden" name="user_id" value="{{ $user->id }}">
    <div>
        <label for="content">Content:</label>
        <textarea id="content" name="content" required></textarea>
    </div>
    <button type="submit">Add Comment</button>
</form>
@endsection
