@extends('layout')

@section('content')
<h2>Orders</h2>
<a href="{{ route('order.createOrder') }}" class="btn btn-success mb-3">Add Order</a>
<table class="table table-bordered">
    <tr>
        <th>Order Number</th>
        <th>Customer Name</th>
        <th>Quantity</th>
        <th>Total Price</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    @foreach($orders as $order)
    <tr>
        <td>{{ $order->order_number }}</td>
        <td>{{ $order->user->username }}</td>
        <td>{{ $order->transaction->details->count() }}</td>
        <td>${{ number_format($order->total_price, 2) }}</td>
        <td>{{ $order->status }}</td>
        <td>
            <a href="{{ route('order.show', $order->id) }}" class="btn btn-info">View</a>
            <a href="{{ route('order.edit', $order->id) }}" class="btn btn-warning">Edit</a>
    
            <form action="{{ route('order.destroy', $order->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this order?');">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
