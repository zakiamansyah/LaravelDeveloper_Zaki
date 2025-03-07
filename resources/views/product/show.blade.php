@extends('layout')

@section('content')
<div class="container">
    <h2 class="mb-4">Product Details</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">Category: {{ $product->category->name }}</h6>
            <p class="card-text"><strong>Description:</strong> {{ $product->description }}</p>
            <p class="card-text"><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
            <p class="card-text"><strong>Stock:</strong> {{ $product->stock }}</p>

            <a href="{{ route('product') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
@endsection
