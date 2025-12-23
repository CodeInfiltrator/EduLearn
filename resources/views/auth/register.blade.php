@extends('layouts.main')

@section('title','Register')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow rounded-4 border-0">
            <div class="card-body p-4">
                <h4 class="fw-bold mb-3 text-center">Create Account</h4>

                <form method="POST" action="/register">
                    @csrf

                    <input name="name" class="form-control mb-3" placeholder="Name" required>
                    <input name="email" class="form-control mb-3" placeholder="Email" required>
                    <input name="password" type="password" class="form-control mb-3" placeholder="Password" required>
                    <input name="password_confirmation" type="password" class="form-control mb-3" placeholder="Confirm Password" required>

                    <button class="btn btn-success w-100">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
