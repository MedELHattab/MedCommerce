<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Detail;
use App\Services\ProductService;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Size;




class CartController{
    public function productCart()
    {
        return view('cart');
    }
    public function addProducttoCart($id, Request $request)
{
    // Retrieve size and color from the request
    $size = $request->size;
    $color = $request->color;

    // Fetch product details based on ID, size, and color
    $detail = Detail::with("size", "color")->where("product_id", $id)->where("size_id", $size)->where("color_id", $color)->first();

    // If detail is found
    if ($detail) {

        if ($detail->number <= 0) {
            return redirect()->back()->with('error', 'This product is out of stock.');
        }

        $product = Product::findOrFail($id); 
        $colorName = $detail->color->name;
        $sizeName = $detail->size->name;

        // Prepare the product data
        $productData = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'image' => $product->image,
            'color' => $colorName,
            'size' => $sizeName,
            'quantity' => 1, 
        ];

        // Check if the product already exists in the cart
        $cart = session()->get('cart', []);
        foreach ($cart as $key => $item) {
            if ($item['id'] === $product->id && $item['color'] === $colorName && $item['size'] === $sizeName) {

                $cart[$key]['quantity']++;
                $array = array_filter(array_merge(array(0), $cart));
                // dd($array);

                session()->put('cart', $array);

                return redirect()->back()->with('success', 'Product quantity updated in cart.');
            }
        }

      
        session()->push('cart', $productData);

        return redirect()->back()->with('success', 'Product added to cart successfully.');
    } else {
        
        return redirect()->back()->with('error', 'Product detail not found.');
    }
}



public function updateCart(Request $request)
{

    
    if ($request->id && $request->quantity) {
        $cart = session()->get('cart', []);
        $cart = array_filter(array_merge(array(0), $cart));
        if (isset($cart[$request->id])) {
            
            $cart[$request->id]["quantity"] = $request->quantity;

            // Update the cart in the session
            session()->put('cart', $cart);

            session()->flash('success', 'Product quantity updated in cart.');
        }
        return redirect()->back();
    }
}



    public function deleteProduct(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            $cart = array_filter(array_merge(array(0), $cart));

            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product successfully deleted.');
        }
        return redirect()->back();
    }
}








