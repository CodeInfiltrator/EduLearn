<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // PUBLIC LIST
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // PUBLIC DETAIL
    public function show($id)
    {
        $category = Category::with('courses')->findOrFail($id);
        return view('categories.show', compact('category'));
    }

    // ADMIN LIST
    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        Category::create($request->all());
        return redirect('/admin/categories');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return redirect('/admin/categories');
    }

    public function destroy($id)
    {
        Category::destroy($id);
        return redirect('/admin/categories');
    }
}

