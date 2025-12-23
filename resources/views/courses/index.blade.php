@extends('layouts.main')
@section('title','Courses')
@section('content')

<h2 class="fw-bold mb-3">🎓 All Courses</h2>

<div class="row g-4">

<form method="GET" action="{{ url('/courses') }}" class="row g-3 mb-4">

    <!-- SEARCH -->
    <div class="col-md-6">
        <input type="text"
               name="search"
               class="form-control"
               placeholder="Search course title..."
               value="{{ request('search') }}">
    </div>

    <!-- FILTER CATEGORY -->
    <div class="col-md-4">
        <select name="category" class="form-select">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}"
                    {{ request('category') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- BUTTON -->
    <div class="col-md-2 d-grid">
        <button class="btn btn-primary">
            <i class="bi bi-search"></i> Search
        </button>
    </div>

</form>

@if($courses->isEmpty())
    <div class="col-12">
        <div class="alert alert-warning text-center">
            😕 No courses found.
        </div>
    </div>
@endif

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
