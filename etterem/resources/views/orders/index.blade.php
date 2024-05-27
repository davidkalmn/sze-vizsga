@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Orders</h1>
    <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Create Order</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer Name</th>
                <th>Products</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Actions</th>
                <th>Change Status</th> <!-- New column for changing status -->
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->customer_name }}</td>
                <td>
                    <ul>
                        @foreach ($order->products as $product)
                            <li>{{ $product->name }} - ${{ $product->price }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    ${{ $order->products->sum('pivot.total_price') }}
                </td>
                <td>
                    <span class="badge badge-info">{{ $order->status }}</span>
                </td>
                <td>
                    <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        <input type="hidden" name="status" value="kész">
                        <button type="submit" class="btn btn-success btn-sm">Kész</button>
                    </form>
                    <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        <input type="hidden" name="status" value="készítés alatt">
                        <button type="submit" class="btn btn-secondary btn-sm">Készítés alatt</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
