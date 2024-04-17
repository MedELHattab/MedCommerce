<?php

namespace App\Repositories;
use Illuminate\Support\Facades\Session;



use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function all()
    {
        return Product::all();
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update(array $data, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($data);
        return $product;
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
    }

    public function addProducttoCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = Session::get('cart', []);
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
        Session::put('cart', $cart);
    }

    public function updateCart($id, $quantity)
    {
        $cart = Session::get('cart');
        if($cart && isset($cart[$id])) {
            $cart[$id]["quantity"] = $quantity;
            Session::put('cart', $cart);
        }
    }

    public function deleteProduct($id)
    {
        $cart = Session::get('cart');
        if($cart && isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }
    }

    public function find($id)
    {
        return Product::findOrFail($id);
    }
}