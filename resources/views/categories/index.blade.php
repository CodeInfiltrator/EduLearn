@extends('layouts.main')
@section('title','Categories')
@section('content')

<h2 class="fw-bold mb-4">📂 Course Categories</h2>

<div class="row g-4">
@foreach($categories as $cat)
<div class="col-md-4">
    <div class="card shadow-sm border-0 rounded-4">

        <img src="https://picsum.photos/seed/cat{{ $cat->id }}/400/200"
             class="card-img-top rounded-top-4">

        <div class="card-body">
            <h5 class="fw-bold">{{ $cat->name }}</h5>
            <p>{{ $cat->description }}</p>

            <a href="/categories/{{ $cat->id }}" class="btn btn-outline-primary w-100">
                View Courses
            </a>
        </div>
    </div>
</div>
@endforeach
</div>

@endsection
