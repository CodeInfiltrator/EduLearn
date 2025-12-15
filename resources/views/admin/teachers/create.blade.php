@extends('layouts.main')

@section('title','Add Teacher')

@section('content')

<h2 class="mb-3">Add Teacher</h2>

<form action="/admin/teachers" method="POST" class="bg-white p-4 shadow-sm rounded">
    @csrf

    <label class="form-label">Teacher Name</label>
    <input type="text" name="name" class="form-control mb-3" required>

    <label class="form-label">Expertise</label>
    <input type="text" name="expertise" class="form-control mb-3">

    <button class="btn btn-success">Save</button>
</form>

@endsection
