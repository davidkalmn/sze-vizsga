
@extends('layouts.app')

@section('content')
<h1>Edit Post</h1>
<form method="POST" action="{{ route('posts.update', [$user, $post]) }}">
    @csrf
    @method('PUT')
    <div>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="{{ $post->title }}" required>
    </div>
    <div>
        <label for="summary">Summary:</label>
        <input type="text" id="summary" name="summary" value="{{ $post->summary }}" required>
    </div>
    <div>
        <label for="content">Content:</label>
        <textarea id="content" name="content" required>{{ $post->content }}</textarea>
    </div>
    <button type="submit">Update Post</button>
</form>
@endsection
