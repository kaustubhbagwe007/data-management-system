<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('all', Category::class);

        $categories = Category::latest()->paginate(10);

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('all', Category::class);

        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        Gate::authorize('all', Category::class);

        Category::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->back()->with('success', 'Category added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        Gate::authorize('all', Category::class);

        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        Gate::authorize('all', Category::class);

        $category->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->back()->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Gate::authorize('all', Category::class);

        $category->products()->delete();
        
        $category->delete();

        return redirect()->back()->with('success', 'Category and its products deleted successfully');
    }
}
