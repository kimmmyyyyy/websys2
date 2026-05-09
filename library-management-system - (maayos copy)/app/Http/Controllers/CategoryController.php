<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('books')->paginate(15);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
        ]);

        $category = Category::create($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'description' => "Added category: {$category->name}",
            'model_type' => 'Category',
            'model_id' => $category->id,
        ]);

        return redirect('/admin/categories')->with('success', 'Category added successfully.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'description' => "Updated category: {$category->name}",
            'model_type' => 'Category',
            'model_id' => $category->id,
        ]);

        return redirect('/admin/categories')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $name = $category->name;

        if ($category->books()->count() > 0) {
            return back()->with('error', 'Cannot delete category with associated books.');
        }

        $category->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'description' => "Deleted category: {$name}",
            'model_type' => 'Category',
            'model_id' => $category->id,
        ]);

        return redirect('/admin/categories')->with('success', 'Category deleted successfully.');
    }
}
