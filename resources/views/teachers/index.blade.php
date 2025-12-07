@extends('layouts.main')
@section('title','Teachers')
@section('content')

<h2 class="fw-bold mb-4">👩‍🏫 Our Teachers</h2>

<div class="row g-4">

@foreach($teachers as $t)
<div class="col-md-4">
    <div class="card shadow-sm border-0 rounded-4 text-center p-3">

        <img src="https://picsum.photos/seed/teacher{{ $t->id }}/200"
             class="rounded-circle mx-auto mb-3" width="120" height="120">

        <h5 class="fw-bold">{{ $t->name }}</h5>
        <p class="text-muted">{{ $t->expertise }}</p>

        <a href="/teachers/{{ $t->id }}" class="btn btn-primary w-100">
            View Profile
        </a>
    </div>
</div>
@endforeach

</div>

@endsection
