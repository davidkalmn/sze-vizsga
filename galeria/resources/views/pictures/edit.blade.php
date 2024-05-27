@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Picture</h1>
    <form action="{{ route('pictures.update', $picture) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $picture->title }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ $picture->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="img">Image</label>
            <input type="file" name="img" id="img" class="form-control">
        </div>
        @if($picture->img)
            <img src="{{ asset('storage/' . $picture->img) }}" alt="{{ $picture->title }}" style="max-width: 200px;">
        @endif
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
