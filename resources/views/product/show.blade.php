@extends('layout')

@section('content')
<h2>Product Details</h2>
<p><strong>Name:</strong> {{ $product->name }}</p>
<p><strong>Category:</strong> {{ $product->category->name }}</p>
<p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
<p><strong>Stock:</strong> {{ $product->stock }}</p>

<a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Products</a>
@endsection
