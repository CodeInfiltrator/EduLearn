@extends('layouts.main')
@section('title', $category->name)
@section('content')

<h2>{{ $category->name }}</h2>
<p class="text-muted">{{ $category->description }}</p>

<h4 class="mt-4">Courses in this category:</h4>

<ul class="list-group mt-3">
@foreach($category->courses as $course)
    <li class="list-group-item">
        <a href="/courses/{{ $course->id }}">{{ $course->title }}</a>
    </li>
@endforeach
</ul>

@endsection
