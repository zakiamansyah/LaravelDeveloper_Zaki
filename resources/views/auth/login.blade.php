@extends('layout')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Login</div>
            <div class="card-body">
                <form method="post" action="{{ url('/login') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>

                <div class="mt-3 text-center">
                    <p>Don't have an account?</p>
                    <a href="{{ url('register') }}" class="btn btn-danger">Register</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
