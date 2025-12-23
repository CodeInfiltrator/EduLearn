@extends('layouts.main')

@section('title','Login')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow rounded-4 border-0">
            <div class="card-body p-4">
                <h4 class="fw-bold mb-3 text-center">🎓 Student Login</h4>

                <form method="POST" action="/login">
                    @csrf

                    <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
                    <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

                    <button class="btn btn-primary w-100">Login</button>
                </form>

                <p class="text-center mt-3">
                    Don't have an account? <a href="/register">Register</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
