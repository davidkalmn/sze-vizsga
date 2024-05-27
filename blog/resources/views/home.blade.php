@extends('layouts.app')

@section('content')
<nav>
    <ul>
        @foreach($users as $u)
        <li>
            <a href="{{ route('home', $u->id) }}">{{ $u->username }}</a>
        </li>
        @endforeach
    </ul>
</nav>

@if($user)
<button onclick="event.preventDefault(); createPost({{ $user->id }});">Create Post</button>
@endif

<h1>All Posts</h1>
<ul>
    @foreach($posts as $post)
    <li>
        <h2>{{ $post->title }}</h2>
        <p>{{ $post->summary }}</p>
        <p>{{ $post->content }}</p>
        <p>Author: {{ $post->user->username }}</p>
        <p>Created at: {{ $post->created_at }}</p>
        @if($user && $user->id == $post->user_id)
        <a href="{{ route('posts.edit', [$user->id, $post->id]) }}">Edit</a>
        <form method="POST" action="{{ route('posts.destroy', [$user->id, $post->id]) }}" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
        @endif
        <h3>Comments</h3>
        <ul>
            @foreach($post->comments as $comment)
            <li>
                <strong>{{ $comment->user->username }}:</strong> {{ $comment->content }}
            </li>
            @endforeach
            @if($post->comments->isEmpty())
                <p>No comments yet.</p>
            @endif
        </ul>
        @if($user)
        <h3>Add a Comment</h3>
        <form method="POST" action="{{ route('posts.comments.store', $post->id) }}">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <div>
                <label for="content">Content:</label>
                <textarea id="content" name="content" required></textarea>
            </div>
            <button type="submit">Add Comment</button>
        </form>
        @endif
    </li>
    @endforeach
    @if($posts->isEmpty())
        <p>No posts available.</p>
    @endif
</ul>

<script>
    function createPost(userId) {
        window.location.href = `/users/${userId}/posts/create`;
    }
</script>
@endsection
