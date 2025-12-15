@extends('layouts.main')

@section('title','Edit Teacher')

@section('content')

<h2 class="mb-3">Edit Teacher</h2>

<form action="/admin/teachers/{{ $teacher->id }}" method="POST" class="bg-white p-4 shadow-sm rounded">
    @csrf @method('PUT')

    <label class="form-label">Teacher Name</label>
    <input type="text" name="name" value="{{ $teacher->name }}" class="form-control mb-3" required>

    <label class="form-label">Expertise</label>
    <input type="text" name="expertise" value="{{ $teacher->expertise }}" class="form-control mb-3">

    <button class="btn btn-primary">Update</button>
</form>

@endsection
