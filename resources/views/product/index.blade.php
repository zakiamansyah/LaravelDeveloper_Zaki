@extends('layout')

@section('content')
<h2>Products</h2>
<a href="{{ route('products.create') }}" class="btn btn-success mb-3">Add Product</a>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Category</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Actions</th>
    </tr>
    @foreach($products as $product)
    <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->category->name }}</td>
        <td>${{ number_format($product->price, 2) }}</td>
        <td>{{ $product->stock }}</td>
        <td>
            <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">View</a>
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
