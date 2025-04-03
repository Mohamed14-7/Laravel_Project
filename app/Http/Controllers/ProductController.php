<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(3);
        return view('admin.products.index', compact('products'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->category_id = $request->category;
        $product->description = $request->description;
        $product->save();
        return redirect()->back();
    }
    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::findOrFail($id);
        $category_name = Category::where('id', $product->category_id)->first()->name;
        return view('admin.products.edit', compact('product', 'categories', 'category_name'));
    }
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->category_id = $request->category;
        $product->description = $request->description;
        $product->save();
        return redirect('products');
    }
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->back();
    }
}
