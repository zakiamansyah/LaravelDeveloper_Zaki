@extends('layout')

@section('content')
    <h2>Category Details</h2>

    <p><strong>ID:</strong> {{ $category->id }}</p>
    <p><strong>Name:</strong> {{ $category->name }}</p>

    <a href="{{ route('category') }}" class="btn btn-secondary">Back to Categories</a>
    <a href="{{ route('category.update', $category->id) }}" class="btn btn-warning">Edit</a>

    <form action="{{ route('category.delete', $category->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?');">Delete</button>
    </form>
@endsection
