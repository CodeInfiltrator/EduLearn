@extends('layouts.main')
@section('title','My Courses')

@section('content')

<h2 class="fw-bold mb-4">📘 My Courses</h2>

@if($courses->count() === 0)
<div class="alert alert-info rounded-4">
    You have not enrolled in any courses yet.
</div>
@endif

<div class="row g-4">
@foreach($courses as $course)
<div class="col-md-4">
    <div class="card shadow-sm border-0 rounded-4 h-100">

        <img src="https://picsum.photos/seed/mycourse{{ $course->id }}/400/250"
             class="card-img-top rounded-top-4">

        <div class="card-body d-flex flex-column">
            <h5 class="fw-bold">{{ $course->title }}</h5>

            <p class="text-muted mb-1">
                <i class="bi bi-tags"></i> {{ $course->category->name }}
            </p>

            <p class="text-muted">
                <i class="bi bi-person-circle"></i> {{ $course->teacher->name }}
            </p>

            {{-- CONTINUE --}}
            <a href="{{ route('courses.learn', $course->id) }}"
                class="btn btn-primary mt-auto w-100">
                Continue Learning
            </a>


            {{-- UNENROLL (INI YANG DITAMBAHKAN) --}}
            <form action="{{ route('courses.unenroll', $course->id) }}"
                  method="POST">
                @csrf
                @method('DELETE')

                <button class="btn btn-outline-danger w-100"
                        onclick="return confirm('Unenroll from this course?')">
                    Unenroll
                </button>
            </form>

        </div>
    </div>
</div>
@endforeach
</div>

@endsection
