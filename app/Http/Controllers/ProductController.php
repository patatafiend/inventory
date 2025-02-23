<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);
    
        if ($validator->fails()) {
            $errors[] = "invalid input";
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $product = Product::create($request->all());
    
        $html = view('products.partials.product-row', compact('product'))->render();
    
        return response()->json([
            'success' => 'added',
            'message' => 'Product added successfully!',
            'html' => $html
        ]);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found']);
        }
        $html = view('products.partials.product_details', compact('product'))->render();
        return response()->json(['success' => 'shown', 'html' => $html]);
    }
    

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }
    
    
    

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $name = $product->name;
        $description = $product->description;
        $quantity = $product->quantity;
        $price = $product->price;

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ]);


        if($name == $request->name && $description && $request->description &&
        $quantity == $request->quantity && $price == $request->price){
            return response()->json(['success' => 'no_changes', 'message' => 'Product updated successfully']);
        }else{
            return response()->json(['success' => 'updated', 'message' => 'Product updated']);
        }
        
    }
    
    

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['success' => 'product missing', 'message' => 'Product not found'], 404);
        }
    
        $product->delete();
    
        return response()->json([
            'success' => 'deleted', 
            'message' => 'Product deleted successfully']);
    }
    
}
