<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use App\Models\Teacher;
use Validator;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with(['category', 'teacher'])->get();
        $categories = Category::all();
        $teachers = Teacher::all();

        return view('admin.courses.index', compact('courses', 'categories', 'teachers'));
    }

    public function create()
    {
        // not used (modal), but keep for compatibility
        return response()->json([
            'categories' => Category::all(),
            'teachers' => Teacher::all()
        ]);
    }

    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'title' => 'required|string|max:191',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        if ($v->fails()) {
            return response()->json(['status'=>'error','errors'=>$v->errors()], 422);
        }

        $course = Course::create($v->validated());
        $course->load(['category','teacher']);

        return response()->json(['status'=>'success','message'=>'Course created','data'=>$course]);
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $course
        ]);
    }


    public function update(Request $request, $id)
    {
        $v = Validator::make($request->all(), [
            'title' => 'required|string|max:191',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        if ($v->fails()) {
            return response()->json(['status'=>'error','errors'=>$v->errors()], 422);
        }

        $course = Course::findOrFail($id);
        $course->update($v->validated());
        $course->load(['category','teacher']);

        return response()->json(['status'=>'success','message'=>'Course updated','data'=>$course]);
    }

    public function destroy($id)
    {
        Course::destroy($id);
        return response()->json(['status'=>'success','message'=>'Course deleted']);
    }
}
