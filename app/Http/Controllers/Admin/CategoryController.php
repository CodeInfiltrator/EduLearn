<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'description' => 'nullable|string',
        ]);

        if ($v->fails()) {
            return response()->json(['status'=>'error','errors'=>$v->errors()], 422);
        }

        $category = Category::create($v->validated());

        return response()->json(['status'=>'success','message'=>'Category created','data'=>$category]);
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return response()->json(['status'=>'success','data'=>$category]);
    }

    public function update(Request $request, $id)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'description' => 'nullable|string',
        ]);

        if ($v->fails()) {
            return response()->json(['status'=>'error','errors'=>$v->errors()], 422);
        }

        $category = Category::findOrFail($id);
        $category->update($v->validated());

        return response()->json(['status'=>'success','message'=>'Category updated','data'=>$category]);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['status'=>'success','message'=>'Category deleted']);
    }
}
