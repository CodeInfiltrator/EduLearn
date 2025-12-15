@extends('layouts.main')
@section('title', 'Home')

@section('content')

<!-- ================= HERO SECTION ================= -->
<div class="hero-wrapper position-relative overflow-hidden rounded-4 shadow-lg mb-5">

    <!-- VIDEO BACKGROUND -->
    <video autoplay muted loop playsinline class="hero-video">
        <source src="{{ asset('videos/learning.mp4') }}" type="video/mp4">
    </video>

    <!-- OVERLAY -->
    <div class="hero-overlay"></div>

    <!-- HERO CONTENT -->
    <div class="hero-content text-white">
        <h1 class="display-4 fw-bold">Belajar Mudah, Cepat, dan Efektif</h1>
        <p class="fs-5 col-md-8">
            Platform micro-learning untuk kamu yang ingin belajar secara singkat,
            terstruktur, dan fleksibel kapan saja dan di mana saja.
        </p>
        <a href="{{ url('/courses') }}" class="btn btn-warning btn-lg fw-bold mt-2">
            🚀 Explore Courses
        </a>
    </div>

</div>
<!-- ================= END HERO ================= -->

<h3 class="fw-bold">📚 Popular Categories</h3>

<div class="row mt-4">

@foreach(\App\Models\Category::limit(3)->get() as $cat)
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0 rounded-4 h-100">

            <img
                src="https://picsum.photos/seed/edu{{ $cat->id }}/400/200"
                class="card-img-top rounded-top-4"
                alt="{{ $cat->name }}"
            >


            <div class="card-body">
                <h5 class="fw-bold">{{ $cat->name }}</h5>
                <p>{{ $cat->description }}</p>
                <a href="{{ url('/categories/'.$cat->id) }}" class="btn btn-outline-primary">
                    View Courses
                </a>
            </div>

        </div>
    </div>
@endforeach

</div>

@endsection
