<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();
        return view('teachers.index', compact('teachers'));
    }

    public function show($id)
    {
        $teacher = Teacher::with('courses')->findOrFail($id);
        return view('teachers.show', compact('teacher'));
    }

    // ADMIN
    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
        Teacher::create($request->all());
        return redirect('/admin/teachers');
    }

    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->update($request->all());
        return redirect('/admin/teachers');
    }

    public function destroy($id)
    {
        Teacher::destroy($id);
        return redirect('/admin/teachers');
    }
}

