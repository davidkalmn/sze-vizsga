@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Order</h1>
    <form method="POST" action="{{ route('orders.store') }}">
        @csrf
        <div class="form-group">
            <label for="customer_name">Customer Name</label>
            <input type="text" class="form-control" id="customer_name" name="customer_name" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="készítés alatt">Készítés alatt</option>
                <option value="kész">Kész</option>
            </select>
        </div>
        <div class="form-group">
            <label for="products">Products</label>
            <select multiple class="form-control" id="products" name="products[]" required>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }} - ${{ $product->price }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
    <a href="{{ route('orders.index') }}" class="btn btn-secondary mt-3">Back to Orders</a>
</div>
@endsection
