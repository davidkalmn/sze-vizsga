<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('products')->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $products = Product::all();
        return view('orders.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'products' => 'required|array',
            'products.*' => 'exists:products,id',
            'status' => 'required|in:kész,készítés alatt',
        ]);

        $order = Order::create([
            'customer_name' => $request->customer_name,
            'status' => $request->status,
        ]);

        foreach ($request->products as $productId) {
            $product = Product::find($productId);
            $order->products()->attach($productId, [
                'total_price' => $product->price
            ]);
        }

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    public function edit($id)
    {
        $order = Order::with('products')->findOrFail($id);
        $products = Product::all();
        return view('orders.edit', compact('order', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'products' => 'required|array',
            'products.*' => 'exists:products,id',
            'status' => 'required|in:kész,készítés alatt',
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'customer_name' => $request->customer_name,
            'status' => $request->status,
        ]);

        $order->products()->detach();
        foreach ($request->products as $productId) {
            $product = Product::find($productId);
            $order->products()->attach($productId, [
                'total_price' => $product->price
            ]);
        }

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return redirect()->route('orders.index')->with('success', 'Order status updated successfully.');
    }
}
