@extends('layout')

@section('content')
<h2>Order Details</h2>
<p><strong>Customer Name:</strong> {{ $order->user->username }}</p>
<p><strong>Total Price:</strong> ${{ number_format($order->total_price, 2) }}</p>
<p><strong>Status:</strong> {{ $order->status }}</p>

<h4>Products:</h4>
<table class="table table-bordered">
    <tr>
        <th>Product</th>
        {{-- <th>Quantity</th> --}}
        <th>Price</th>
    </tr>
    @foreach($order->products as $product)
    <tr>
        <td>{{ $product->name }}</td>
        {{-- <td>{{ $product->pivot->quantity }}</td> --}}
        <td>${{ number_format($product->price, 2) }}</td>
    </tr>
    @endforeach
</table>

<a href="{{ route('order') }}" class="btn btn-secondary">Back to Orders</a>
@endsection
