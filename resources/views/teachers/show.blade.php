@extends('layouts.main')
@section('title',$teacher->name)
@section('content')

<div class="card shadow-lg border-0 rounded-4 p-4">

    <div class="text-center">
        <img src="https://picsum.photos/seed/teacher_detail{{ $teacher->id }}/250"
             class="rounded-circle mb-3 shadow" width="150" height="150">

        <h2 class="fw-bold">{{ $teacher->name }}</h2>
        <p class="text-muted">{{ $teacher->expertise }}</p>
    </div>

    <h4 class="mt-4">Courses by this teacher:</h4>

    <ul class="list-group mt-2">
    @foreach($teacher->courses as $course)
        <li class="list-group-item">
            <a href="/courses/{{ $course->id }}">{{ $course->title }}</a>
        </li>
    @endforeach
    </ul>

</div>

@endsection
