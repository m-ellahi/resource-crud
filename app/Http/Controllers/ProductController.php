<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return view ('product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        return view ('product.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        if ($request->hasFile('product_image')) {
            $imagePath = $request->file('product_image')->store('uploads/products', 'public');
            $validated['product_image'] = $imagePath;
        }

        Product::create($validated);
        return redirect()->route('product.index')->with('success', 'Product Added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $product = Product::with('category')->findOrFail($id);
        $categories=Category::all();
        return view('product.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'product_name' => 'required',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $product = Product::findOrFail($id);

        $product->product_name = $request->input('product_name');
        $product->category_id = $request->input('category_id');
        $product->price = $request->input('price');
        $product->description = $request->input('description');

        if ($request->hasFile('product_image')) {
            $imagePath = $request->file('product_image')->store('uploads/products', 'public');
            $product_image = $imagePath;
            $product->product_image=$product_image;
        }

        $product->save();

        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
            
        }

        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
        
    }
}
