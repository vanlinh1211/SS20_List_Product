<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use mysql_xdevapi\Session;

class ProductController extends Controller
{
    public function home(){
        return view('home');
    }

    public function show(){
        $products = Product::all();
        return view('products.list', compact('products'));
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request){
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->old_price = $request->old_price;
        if ($request->hasFile('image')){
            $image = $request->image;
            $path = $image->store('images', 'public');
            $product->image = $path;
        }
        $product->save();
        return redirect()->route('products.create');
    }

    public function delete($id){
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.list');
    }
}
