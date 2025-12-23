<?php

namespace App\Http\Controllers;

use App\Models\Lesson;

class LessonController extends Controller
{
    public function index(Course $course)
    {
        $lessons = $course->lessons;
        return view('courses.learn', compact('course','lessons'));
    }

    public function show(Lesson $lesson)
    {
        return view('lessons.show', compact('lesson'));
    }
}

