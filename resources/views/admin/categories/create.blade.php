@extends('layouts.main')

@section('title','Create Category')

@section('content')

<h2 class="mb-3">Add Category</h2>

<form action="/admin/categories" method="POST" class="bg-white p-4 shadow-sm rounded">
    @csrf

    <label class="form-label">Category Name</label>
    <input type="text" name="name" class="form-control mb-3" required>

    <label class="form-label">Description</label>
    <textarea name="description" class="form-control mb-3"></textarea>

    <button class="btn btn-success">Save</button>
</form>

@endsection
