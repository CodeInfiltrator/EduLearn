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

        <p class="fs-5">{{ $course->description }}</p>

    </div>
</div>

@endsection
