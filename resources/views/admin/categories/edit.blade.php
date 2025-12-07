@extends('layouts.main')

@section('title','Edit Category')

@section('content')

<h2 class="mb-3">Edit Category</h2>

<form action="/admin/categories/{{ $category->id }}" method="POST" class="bg-white p-4 shadow-sm rounded">
    @csrf @method('PUT')

    <label class="form-label">Category Name</label>
    <input type="text" name="name" value="{{ $category->name }}" class="form-control mb-3" required>

    <label class="form-label">Description</label>
    <textarea name="description" class="form-control mb-3">{{ $category->description }}</textarea>

    <button class="btn btn-primary">Update</button>
</form>

@endsection
