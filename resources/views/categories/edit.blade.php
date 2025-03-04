@extends('layout')

@section('content')
<h2>Edit Category</h2>
<form method="POST" action="{{ route('categories.update', $category->id) }}">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="form-label">Category Name</label>
        <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
    </div>
    <button type="submit" class="btn btn-warning">Update</button>
</form>
@endsection
