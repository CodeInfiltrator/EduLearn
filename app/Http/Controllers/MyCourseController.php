<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class MyCourseController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $courses = $user->courses()
                        ->with(['category','teacher'])
                        ->get();

        return view('mycourses.index', compact('courses'));
    }
}
