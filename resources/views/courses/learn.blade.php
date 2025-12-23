@extends('layouts.main')

@section('title', $course->title)

@section('content')

<div class="row">
    <!-- SIDEBAR LESSON -->
    <div class="col-md-4">
        <div class="list-group rounded-4 shadow-sm">
            @foreach($course->lessons as $lesson)
                <a href="#lesson-{{ $lesson->id }}"
                   class="list-group-item list-group-item-action">
                    {{ $lesson->order }}. {{ $lesson->title }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- CONTENT -->
    <div class="col-md-8">
        @foreach($course->lessons as $lesson)
            <div id="lesson-{{ $lesson->id }}" class="mb-5">
                <h4 class="fw-bold">{{ $lesson->title }}</h4>

                @if($lesson->video_url)
                    <iframe width="100%" height="315"
                            src="{{ $lesson->video_url }}"
                            allowfullscreen></iframe>
                @endif

                <div class="mt-3">
                    {!! $lesson->content !!}
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
