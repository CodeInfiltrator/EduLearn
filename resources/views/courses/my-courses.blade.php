@extends('layouts.main')
@section('title','My Courses')

@section('content')

<h2 class="fw-bold mb-4">📘 My Courses</h2>

<div class="row g-4">

@forelse($courses as $course)
<div class="col-md-4">
    <div class="card shadow-sm border-0 rounded-4">

        <img src="https://picsum.photos/seed/my{{ $course->id }}/400/250"
             class="card-img-top rounded-top-4">

        <div class="card-body">
            <h5 class="fw-bold">{{ $course->title }}</h5>

            <p class="text-muted mb-0">
                <i class="bi bi-tags"></i> {{ $course->category->name }}
            </p>

            <p class="text-muted">
                <i class="bi bi-person-circle"></i> {{ $course->teacher->name }}
            </p>

            <a href="/courses/{{ $course->id }}" class="btn btn-outline-primary w-100">
                View Course
            </a>
        </div>
    </div>
</div>
@empty
    <div class="col-12">
        <div class="alert alert-info text-center">
            You haven't enrolled in any course yet.
        </div>
    </div>
@endforelse

</div>

@endsection
