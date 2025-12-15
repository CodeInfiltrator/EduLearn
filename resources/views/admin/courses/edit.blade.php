@extends('layouts.main')

@section('title','Edit Course')

@section('content')

<h2 class="mb-3">Edit Course</h2>

<form action="/admin/courses/{{ $course->id }}" method="POST" class="bg-white p-4 shadow-sm rounded">
    @csrf @method('PUT')

    <label class="form-label">Course Title</label>
    <input type="text" name="title" value="{{ $course->title }}" class="form-control mb-3" required>

    <label class="form-label">Description</label>
    <textarea name="description" class="form-control mb-3">{{ $course->description }}</textarea>

    <label class="form-label">Category</label>
    <select name="category_id" class="form-select mb-3" required>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" @if($course->category_id==$cat->id) selected @endif>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>

    <label class="form-label">Teacher</label>
    <select name="teacher_id" class="form-select mb-3" required>
        @foreach($teachers as $t)
            <option value="{{ $t->id }}" @if($course->teacher_id==$t->id) selected @endif>
                {{ $t->name }}
            </option>
        @endforeach
    </select>

    <button class="btn btn-primary">Update</button>
</form>

@endsection
