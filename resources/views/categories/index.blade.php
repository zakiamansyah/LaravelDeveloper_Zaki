@extends('layout')

@section('content')
<h2>Categories</h2>
{{-- <a href="{{ url('categories.create') }}" class="btn btn-success mb-3">Add Category</a> --}}
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Actions</th>
    </tr>
    @foreach($categories as $category)
    <tr>
        <td>{{ $category->id }}</td>
        <td>{{ $category->name }}</td>
        <td>
            {{-- <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit</a> --}}
            {{-- <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;"> --}}
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
