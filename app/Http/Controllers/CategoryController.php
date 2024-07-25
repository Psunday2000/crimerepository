<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // Show the list of categories
    public function index()
    {
        $categories = Category::all();
        return view('categories', compact('categories'));
    }

    // Store a new category
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => ['required', 'string', 'max:255'],
            'category_details' => ['required', 'string'],
        ]);

        Category::create([
            'category_name' => $request->category_name,
            'slug' => Str::slug($request->category_name),
            'category_details' => $request->category_details,
        ]);

        return redirect()->route('categories.index');
    }

    // Delete a category
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index');
    }
}
