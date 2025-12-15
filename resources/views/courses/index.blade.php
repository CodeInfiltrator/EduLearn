@extends('layouts.main')
@section('title','Courses')
@section('content')

<h2 class="fw-bold mb-3">🎓 All Courses</h2>

<div class="row g-4">

@foreach($courses as $course)
<div class="col-md-4">
    <div class="card shadow-sm border-0 rounded-4">

        <img src="https://picsum.photos/seed/course{{ $course->id }}/400/250"
             class="card-img-top rounded-top-4">

        <div class="card-body">
            <h5 class="fw-bold">{{ $course->title }}</h5>

            <p class="text-muted mb-0">
                <i class="bi bi-tags"></i> {{ $course->category->name }}
            </p>

            <p class="text-muted">
                <i class="bi bi-person-circle"></i> {{ $course->teacher->name }}
            </p>

            <a href="/courses/{{ $course->id }}" class="btn btn-primary w-100">
                View Detail
            </a>
        </div>
    </div>
</div>
@endforeach

</div>

@endsection
