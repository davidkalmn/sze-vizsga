@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Product</h1>
    <form method="POST" action="{{ route('products.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
    <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Back to Products</a>
</div>
@endsection
