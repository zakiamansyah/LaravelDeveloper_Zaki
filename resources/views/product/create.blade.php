@extends('layout')

@section('content')
<h2>Add Product</h2>
<form method="POST" action="{{ route('products.store') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label">Product Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Category</label>
        <select name="category_id" class="form-control" required>
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Price</label>
        <input type="number" name="price" class="form-control" step="0.01" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Stock</label>
        <input type="number" name="stock" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
</form>
@endsection
