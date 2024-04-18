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
    public function addProducttoCart($id, Request $request)
{
    // Retrieve size and color from the request
    $size = $request->size;
    $color = $request->color;

    // Fetch product details based on ID, size, and color
    $detail = Detail::with("size", "color")->where("product_id", $id)->where("size_id", $size)->where("color_id", $color)->first();

    // If detail is found
    if ($detail) {

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
