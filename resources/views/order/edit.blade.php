@extends('layout')

@section('content')
<h2>Edit Order</h2>
<form method="POST" action="{{ route('orders.update', $order->id) }}">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="form-label">Customer Name</label>
        <input type="text" name="customer_name" class="form-control" value="{{ $order->customer_name }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Total Amount</label>
        <input type="number" name="total_amount" class="form-control" step="0.01" value="{{ $order->total_amount }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-control" required>
            <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="Completed" {{ $order->status == 'Completed' ? 'selected' : '' }}>Completed</option>
            <option value="Cancelled" {{ $order->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
    </div>
    <button type="submit" class="btn btn-warning">Update</button>
</form>
@endsection
