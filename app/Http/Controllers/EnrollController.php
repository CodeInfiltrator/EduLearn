<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class EnrollController extends Controller
{
    public function enroll(Course $course)
    {
        $user = Auth::user();

        // Prevent double enroll
        if ($user->courses()->where('course_id', $course->id)->exists()) {
            return back()->with('info', 'You already enrolled this course');
        }

        $user->courses()->attach($course->id);

        return back()->with('success', 'Successfully enrolled!');
    }
    public function destroy(Course $course)
    {
        auth()->user()->courses()->detach($course->id);

        return redirect('/my-courses')
            ->with('success', 'You have unenrolled from this course.');
    }

}
