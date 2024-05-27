@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Pictures</h1>

    <!-- Filter and Sort Form -->
    <form method="GET" action="{{ route('pictures.index') }}" class="mb-4">
        <div class="form-row">
            <div class="col">
                <input type="text" name="title" class="form-control" placeholder="Filter by Title" value="{{ request('title') }}">
            </div>
            <div class="col">
                <select name="sort_by" class="form-control">
                    <option value="date" {{ request('sort_by') == 'date' ? 'selected' : '' }}>Sort by Date</option>
                    <option value="title" {{ request('sort_by') == 'title' ? 'selected' : '' }}>Sort by Title</option>
                </select>
            </div>
            <div class="col">
                <select name="sort_order" class="form-control">
                    <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                    <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Descending</option>
                </select>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary">Apply</button>
            </div>
        </div>
    </form>

    <a href="{{ route('pictures.create') }}" class="btn btn-primary mb-4">Upload New Picture</a>

    <ul>
        @foreach($pictures as $picture)
            <li>
                <h2>{{ $picture->title }}</h2>
                <p>{{ $picture->description }}</p>
                <p>{{ $picture->date->format('Y-m-d') }}</p>
                @if($picture->img)
                    <img src="{{ asset('storage/' . $picture->img) }}" alt="{{ $picture->title }}" style="max-width: 200px;">
                @endif
                <a href="{{ route('pictures.edit', $picture) }}" class="btn btn-secondary">Edit</a>
                <form action="{{ route('pictures.destroy', $picture) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
@endsection
