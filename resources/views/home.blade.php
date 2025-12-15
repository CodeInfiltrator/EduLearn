@extends('layouts.main')
@section('title', 'Home')

@section('content')

<div class="p-5 mb-4 rounded-4 shadow-lg"
     style="
        background-image:url('https://img.freepik.com/free-photo/online-learning-concept_23-2148632101.jpg');
        background-size:cover;
        background-position:center;
        min-height:350px;
    ">

    <div class="container py-5 text-white" style="backdrop-filter: brightness(0.25); padding:20px;">
        <h1 class="display-4 fw-bold">Belajar Mudah, Cepat, dan Efektif</h1>
        <p class="fs-5 col-md-8">
            Platform micro-learning untuk kamu yang ingin belajar secara singkat
            & terstruktur. kapan saja dan di mana saja.
        </p>
        <a href="/courses" class="btn btn-warning btn-lg fw-bold">Explore Courses</a>
    </div>
</div>

<h3 class="fw-bold">📚 Popular Categories</h3>

<div class="row mt-4">

@foreach(\App\Models\Category::limit(3)->get() as $cat)
<div class="col-md-4">
    <div class="card shadow-sm border-0 rounded-4">
        <img src="https://picsum.photos/seed/{{ $cat->id }}/400/200" class="card-img-top rounded-top-4">

        <div class="card-body">
            <h5 class="fw-bold">{{ $cat->name }}</h5>
            <p>{{ $cat->description }}</p>
            <a href="/categories/{{ $cat->id }}" class="btn btn-outline-primary">View Courses</a>
        </div>
    </div>
</div>
@endforeach

</div>

@endsection
