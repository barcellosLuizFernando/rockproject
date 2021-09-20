<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {

        $products = Product::orderBy('description')->get();

        return view('register.products.show', ['products' => $products]);
    }

    public function create()
    {
        # code...

        $product = new Product();

        return view('register.products.create', ['product' => $product]);
    }

    public function show($id)
    {
        # code...

        $product = Product::findOrFail($id);

        return view('register.products.create', ['product' => $product]);
    }

    public function update(Request $request)
    {
        # code...
        $product = Product::findOrFail($request->id);

        $product->description = $request->prodName;
        $product->save();

        return redirect('/registers/products');
    }

    public function destroy($id)
    {
        # code...
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('/registers/products');
    }

    public function store(Request $request)
    {
        # code...
        $product = new Product();
        $product->description = $request->prodName;
        $product->save();

        return redirect('/registers/products');
    }
}
