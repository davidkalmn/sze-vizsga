@extends('layouts.app')

@section('content')
<h1>Select a User</h1>
<ul>
    @foreach($users as $user)
    <li><a href="{{ route('users.posts.index', $user) }}">{{ $user->username }}</a></li>
    @endforeach
</ul>
@endsection
