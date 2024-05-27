@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Upload New Picture</h1>
    <form action="{{ route('pictures.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="img">Image</label>
            <input type="file" name="img" id="img" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
@endsection
