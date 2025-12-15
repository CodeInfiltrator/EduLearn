@extends('admin.layouts.admin')

@section('content')

<div class="row g-4">

    <div class="col-md-4">
        <a href="/admin/categories" class="text-decoration-none text-dark">
            <div class="card-modern">
                <h5>Total Categories</h5>
                <h2 class="fw-bold">{{ $categoryCount }}</h2>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="/admin/teachers" class="text-decoration-none text-dark">
            <div class="card-modern">
                <h5>Total Teachers</h5>
                <h2 class="fw-bold">{{ $teacherCount }}</h2>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="/admin/courses" class="text-decoration-none text-dark">
            <div class="card-modern">
                <h5>Total Courses</h5>
                <h2 class="fw-bold">{{ $courseCount }}</h2>
            </div>
        </a>
    </div>

</div>

@endsection
