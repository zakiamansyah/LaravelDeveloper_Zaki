@extends('layout')

@section('content')
<div class="container">
    <h2 class="mt-4">Character Match Calculator</h2>
    <form action="{{ route('character.match.calculate') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Input 1</label>
            <input type="text" name="input1" class="form-control" required value="{{ old('input1') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Input 2</label>
            <input type="text" name="input2" class="form-control" required value="{{ old('input2') }}">
        </div>
        <button type="submit" class="btn btn-primary">Calculate</button>
    </form>

    <div class="alert alert-info mt-3">
        <strong>Result:</strong> {{ session('percentage') }}% of characters from Input 1 appear in Input 2.
    </div>
</div>
@endsection
