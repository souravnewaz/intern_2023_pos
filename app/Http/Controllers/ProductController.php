<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', 1)->paginate(10);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'name' => 'required|string|unique:products,name',
            'price' => 'required|numeric',
            'stock_in' => 'required|numeric',
            'image' => 'required|image|mimes:png,jpg,jpeg'
        ]);

        $imageName = time().'.'.$request->image->extension();
        $path = 'assets/images/items';
        $request->image->move(public_path($path), $imageName);
        
        $input['image'] = $path . '/'. $imageName;
        $input['stock_out'] = 0;
        $input['is_active'] = 1;

        Product::create($input);

        return redirect()->back()->with('success', 'Product Added');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Product $product, Request $request)
    {
        $input = $request->validate([
            'name' => 'required|string|unique:products,name,'.$product->id,
            'price' => 'required|numeric',
            'stock_in' => 'required|numeric',
            'image' => 'nullable|image|mimes:png,jpg,jpeg'
        ]);

        if($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $path = 'assets/images/items';
            $request->image->move(public_path($path), $imageName);
            $input['image'] = $path . '/'. $imageName;
        }    

        $product->update($input);

        return redirect()->back()->with('success', 'Product Updated');
    }

    public function delete(Product $product)
    {
        $product->is_active = false;
        $product->save();

        return redirect()->back()->with('success', 'Product Deleted');
    }
}
