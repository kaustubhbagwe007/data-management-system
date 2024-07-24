<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('all', Product::class);

        $products = Product::latest()->paginate(10);

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('all', Product::class);

        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        Gate::authorize('all', Product::class);

        $category = Category::findOrFail($request->category);
        
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $category->id,
            'image' => $this->uploadFile($request->file('image')) // method in FileUploadTrait file
        ]);

        return redirect()->back()->with('success', 'Product added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        Gate::authorize('all', Product::class);

        $categories = Category::all();
        
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        Gate::authorize('all', Product::class);

        $category = Category::findOrFail($request->category);

        $image = $product->image;

        if ($request->file('image')) {

            $image = $this->uploadFile($request->file('image'));
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $category->id,
            'image' => $image
        ]);

        return redirect()->back()->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Gate::authorize('all', Product::class);

        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully');
    }
}
