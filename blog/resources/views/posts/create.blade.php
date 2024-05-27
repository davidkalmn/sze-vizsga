@extends('layouts.app')

@section('content')
<h1>Create a New Post</h1>
<form method="POST" action="{{ route('posts.store', $user) }}">
    @csrf
    <div>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
    </div>
    <div>
        <label for="summary">Summary:</label>
        <input type="text" id="summary" name="summary" required>
    </div>
    <div>
        <label for="content">Content:</label>
        <textarea id="content" name="content" required></textarea>
    </div>
    <button type="submit">Create Post</button>
</form>
@endsection
