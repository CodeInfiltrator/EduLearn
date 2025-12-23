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
    public function index(Request $request)
    {
        $categories = Category::all();

        $courses = Course::with(['category', 'teacher'])
            ->when($request->search, function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->search . '%');
            })
            ->when($request->category, function ($query) use ($request) {
                $query->where('category_id', $request->category);
            })
            ->latest()
            ->get();

        return view('courses.index', compact('courses', 'categories'));
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

    public function learn(Course $course)
    {
        $course->load(['lessons' => function ($q) {
            $q->orderBy('order');
        }]);

        return view('courses.learn', compact('course'));
    }

}

