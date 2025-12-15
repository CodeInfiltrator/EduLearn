<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use App\Models\Teacher;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with(['category', 'teacher'])->get();
        return view('courses.index', compact('courses'));
    }

    public function show($id)
    {
        $course = Course::with(['category', 'teacher'])->findOrFail($id);
        return view('courses.show', compact('course'));
    }

    // ADMIN

    public function create()
    {
        return view('admin.courses.create', [
            'categories' => Category::all(),
            'teachers' => Teacher::all()
        ]);
    }

    public function store(Request $request)
    {
        Course::create($request->all());
        return redirect('/admin/courses');
    }

    public function edit($id)
    {
        return view('admin.courses.edit', [
            'course' => Course::findOrFail($id),
            'categories' => Category::all(),
            'teachers' => Teacher::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $course->update($request->all());

        return redirect('/admin/courses');
    }

    public function destroy($id)
    {
        Course::destroy($id);
        return redirect('/admin/courses');
    }
}

