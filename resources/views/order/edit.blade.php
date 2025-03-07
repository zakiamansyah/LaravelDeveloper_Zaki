@extends('layout')

@section('content')
<div class="container">
    <h2>Edit Order</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('order.update', $order->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Product</label>
            <select name="product_id" class="form-control">
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ $order->product_id == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Order Number</label>
            <input type="text" name="order_number" value="{{ $order->order_number }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Total Price</label>
            <input type="number" name="total_price" value="{{ $order->total_price }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Shipping Address</label>
            <input type="text" name="shipping_address" value="{{ $order->shipping_address }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Update Order</button>
        <a href="{{ route('order') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
