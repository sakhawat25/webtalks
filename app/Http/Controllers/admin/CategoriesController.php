<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    // Show all categories
    public function index()
    {
        $data['categories'] = Category::latest()->get();        
        return view('admin.categories.index', $data);
    }

    // Show create category form
    public function create()
    {
        return view('admin.categories.create');
    }

    // Store a newly created category into the database
    public function store(Request $request)
    {
        // Perform validation
        $request->validate([
            'name' => 'required|min:3|unique:categories,name'
        ]);

        // Create new category
        Category::create([
            'name' => $request->name
        ]);

        return redirect('admin/categories')->with('message', 'Category has been created successfully!')->with('status', 'success');
    }

    // Show single category
    public function show(Category $category)
    {
        $data['category'] = $category;
        return view('admin.categories.show', $data);
    }

    // Show form for editing the category
    public function edit(Category $category)
    {
        $data['category'] = $category;
        return view('admin.categories.edit', $data);
    }

    // Update the specified category
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|min:3|unique:categories,name,'.$category->id
        ]);

        $category->name = $request->name;
        $category->update();
        return redirect('admin/categories')->with('message', 'Category has been updated successfully!')->with('status', 'success');
    }

    // Delete category
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect('admin/categories')->with('message', 'Category has been deleted successfully!')->with('status', 'success');
    }
}
