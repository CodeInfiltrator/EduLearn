@extends('layouts.main')

@section('title', $lesson->title)

@section('content')

<div class="card shadow border-0 rounded-4">
    <div class="card-body">

        <h2 class="fw-bold mb-3">{{ $lesson->title }}</h2>

        <div class="lesson-content fs-5">
            {!! $lesson->content !!}
        </div>

    </div>
</div>

@endsection
