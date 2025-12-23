@extends('layouts.main')
@section('title', $course->title)

@section('content')

<div class="card shadow-lg border-0 rounded-4 overflow-hidden">

    <img src="https://picsum.photos/seed/detail{{ $course->id }}/1200/400"
         class="w-100">

    <div class="card-body">
        <h2 class="fw-bold">{{ $course->title }}</h2>

        <p class="text-muted">
            <i class="bi bi-tags"></i> {{ $course->category->name }} <br>
            <i class="bi bi-person-fill"></i> {{ $course->teacher->name }}
        </p>

        <div class="course-description fs-5 mb-4">
            {!! $course->description !!}
        </div>

        <hr>

        <h4 class="fw-bold mt-4">📖 Course Lessons</h4>

        <ul class="list-group list-group-flush">
        @foreach($course->lessons as $lesson)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>
                    <i class="bi bi-play-circle me-2"></i>
                    {{ $lesson->title }}
                </span>

                <a href="{{ route('lessons.show', $lesson->id) }}"
                class="btn btn-sm btn-outline-primary">
                    Open
                </a>
            </li>
        @endforeach
        </ul>


        <!-- ===================== -->
        <!-- ENROLL BUTTON SECTION -->
        <!-- ===================== -->
        @auth
            @if(auth()->user()->courses->contains($course->id))
                <button class="btn btn-success w-100" disabled>
                    <i class="bi bi-check-circle"></i> You are Enrolled
                </button>
            @else
                <form method="POST" action="{{ route('courses.enroll', $course->id) }}">
                    @csrf
                    <button class="btn btn-primary w-100">
                        <i class="bi bi-journal-plus"></i> Enroll Course
                    </button>
                </form>
            @endif
        @else
            <a href="{{ route('login') }}" class="btn btn-outline-primary w-100">
                Login to Enroll
            </a>
        @endauth
        <!-- ===================== -->

    </div>
</div>

@endsection
