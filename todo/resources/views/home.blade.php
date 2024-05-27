
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Welcome to the Home Page</h1>
        <p>You are logged in!</p>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </button>
        <!-- Button to redirect to /tasks page -->
        <a href="{{ route('tasks.index') }}" class="btn btn-primary">Go to Tasks</a>
    </div>
@endsection
