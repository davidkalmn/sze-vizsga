@extends('layouts.app')

@section('content')
<h1>Posts by {{ $user->username }}</h1>
<a href="{{ route('users.posts.create', $user) }}">Create a New Post</a>
<ul>
    @foreach($posts as $post)
    <li>
        <a href="{{ route('users.posts.show', [$user, $post]) }}">{{ $post->title }}</a>
        <p>{{ $post->summary }}</p>
    </li>
    @endforeach
</ul>
@endsection
