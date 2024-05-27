@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Order</h1>
    <form method="POST" action="{{ route('orders.update', $order->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="customer_name">Customer Name</label>
            <input type="text" class="form-control" id="customer_name" name="customer_name" value="{{ $order->customer_name }}" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="készítés alatt" {{ $order->status == 'készítés alatt' ? 'selected' : '' }}>Készítés alatt</option>
                <option value="kész" {{ $order->status == 'kész' ? 'selected' : '' }}>Kész</option>
            </select>
        </div>
        <div class="form-group">
            <label for="products">Products</label>
            <select multiple class="form-control" id="products" name="products[]" required>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ in_array($product->id, $order->products->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $product->name }} - ${{ $product->price }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    <a href="{{ route('orders.index') }}" class="btn btn-secondary mt-3">Back to Orders</a>
</div>
@endsection
