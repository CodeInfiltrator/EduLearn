<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::latest()->get();
        return view('admin.teachers.index', compact('teachers'));
    }

    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'expertise' => 'nullable|string|max:191',
            'photo' => 'nullable|image|max:2048'
        ]);

        if ($v->fails()) {
            return response()->json(['status'=>'error','errors'=>$v->errors()], 422);
        }

        $data = $v->validated();

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/teachers');
            $data['photo'] = Storage::url($path); // /storage/...
        }

        $teacher = Teacher::create($data);
        return response()->json(['status'=>'success','message'=>'Teacher created','data'=>$teacher]);
    }

    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        return response()->json(['status'=>'success','data'=>$teacher]);
    }

    public function update(Request $request, $id)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'expertise' => 'nullable|string|max:191',
            'photo' => 'nullable|image|max:2048'
        ]);

        if ($v->fails()) {
            return response()->json(['status'=>'error','errors'=>$v->errors()], 422);
        }

        $teacher = Teacher::findOrFail($id);
        $data = $v->validated();

        if ($request->hasFile('photo')) {
            // delete old if exists (optional)
            if ($teacher->photo) {
                // convert url to storage path
                $oldPath = str_replace('/storage/', 'public/', $teacher->photo);
                Storage::delete($oldPath);
            }
            $path = $request->file('photo')->store('public/teachers');
            $data['photo'] = Storage::url($path);
        }

        $teacher->update($data);
        return response()->json(['status'=>'success','message'=>'Teacher updated','data'=>$teacher]);
    }

    public function destroy($id)
    {
        $t = Teacher::findOrFail($id);
        if ($t->photo) {
            $oldPath = str_replace('/storage/', 'public/', $t->photo);
            \Storage::delete($oldPath);
        }
        $t->delete();
        return response()->json(['status'=>'success','message'=>'Teacher deleted']);
    }
}
