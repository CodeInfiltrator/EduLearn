@extends('layouts.main')

@section('title','Add Course')

@section('content')

<h2 class="mb-3">Add Course</h2>

<form action="/admin/courses" method="POST" class="bg-white p-4 shadow-sm rounded">
    @csrf

    <label class="form-label">Course Title</label>
    <input type="text" name="title" class="form-control mb-3" required>

    <label class="form-label">Description</label>
    <textarea name="description" class="form-control mb-3"></textarea>

    <label class="form-label">Category</label>
    <select name="category_id" class="form-select mb-3" required>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
        @endforeach
    </select>

    <label class="form-label">Teacher</label>
    <select name="teacher_id" class="form-select mb-3" required>
        @foreach($teachers as $t)
            <option value="{{ $t->id }}">{{ $t->name }}</option>
        @endforeach
    </select>

    <button class="btn btn-success">Save</button>
</form>

@endsection
