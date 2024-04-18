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

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService
    ) {
    }

    public function index()
    {
        $products = $this->productService->all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $colors = Color::all();
        $sizes = Size::all();
        $categories = Category::all();
        return view('products.create', compact('sizes', 'colors', 'categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category' => 'required|exists:categories,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/products/';
            $file->move($path, $fileName);
            $data['image'] = $fileName;
        }

        // Resolve category ID from the category name
        $category = Category::findOrFail($request->category);
        $data['category_id'] = $category->id;

        $product = $this->productService->create($data);

        $variances = $request->input('variances');


        foreach ($variances as $color => $sizes) {
            foreach ($sizes as $size => $quantity) {
                // Store details in the details table
                Detail::create([
                    'product_id' => $product->id,
                    'color_id' => $color,
                    'size_id' => $size,
                    'number' => $quantity
                ]);
            }
        }

        return redirect()->route('products');
    }


    public function show($id)
    {
        $sizes = Size::all();
        $colors = Color::all();
        $product = $this->productService->find($id);
        $comments = $product->comments;
        return view('products.show', compact('product', 'colors', 'sizes', 'comments'));
    }

    public function edit($id)
    {
        $colors = Color::all();
        $sizes = Size::all();
        $categories = Category::all();
        $product = $this->productService->find($id);
        return view('products.edit', compact('product', 'colors', 'sizes', 'categories'));
    }

    public function update(Request $request, $id)
    {

        // dd($request);
        $product = Product::findOrFail($id);
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category' => 'required|exists:categories,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $path = 'uploads/categories/';
            $file->move($path, $fileName);
            $data['image'] = $fileName;
        }

        $category = Category::findOrFail($request->category);
        $data['category_id'] = $category->id;

        $product = $this->productService->update($data, $product->id);


        $variances = $request->input('variances');
        $product->details()->delete();

        foreach ($variances as $color => $sizes) {
            foreach ($sizes as $size => $quantity) {

                Detail::create([
                    'product_id' => $product->id,
                    'color_id' => $color,
                    'size_id' => $size,
                    'number' => $quantity
                ]);
            }
        }

        return redirect()->route('products');
    }

    public function destroy($id)
    {
        $this->productService->delete($id);

        return redirect()->route('products');
    }

    public function productCart()
    {
        return view('cart');
    }
    public function addProducttoCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'product has been added to cart!');
    }

    public function updateCart(Request $request)
    {
        // dd($request->id);
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Product quantity updated in cart.');
        }

        return redirect()->back();
    }



    public function deleteProduct(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product successfully deleted.');
        }
        return redirect()->back();
    }
}
