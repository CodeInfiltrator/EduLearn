@extends('admin.layouts.admin')
@section('content')

<h3 class="fw-bold mb-3">
    Lessons – {{ $course->title }}
</h3>

<a href="{{ route('courses.lessons.create', $course->id) }}"
   class="btn btn-primary mb-3">
   + Add Lesson
</a>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Order</th>
            <th>Title</th>
            <th width="180">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($lessons as $lesson)
        <tr>
            <td>{{ $lesson->order }}</td>
            <td>{{ $lesson->title }}</td>
            <td>
                <a href="{{ route('courses.lessons.edit', [$course->id, $lesson->id]) }}"
                   class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('courses.lessons.destroy', [$course->id, $lesson->id]) }}"
                      method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Delete lesson?')">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
