<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Favoris;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

use App\Services\FavorisService;
use Illuminate\Support\Facades\Auth;


class FavorisController extends Controller
{

    public function __construct(
        protected FavorisService $favorisService
    ) {
    }
    public function index()
    {
        $colors = Color::all();
        $sizes = Size::all();
        $user = Auth::user();
        $products = Product::whereHas('favoris', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();
        return view('favoris', compact('products', 'colors', 'sizes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $data = $request->validate([
        'product_name' => 'required',
    ]);

    
    $product = Product::where('name', $data['product_name'])->first();

    
    if (!$product) {
        return redirect()->back()->with('error', 'Product not found.');
    }

    
    $data['user_id'] = auth()->id();

    $data['product_id'] = $product->id;

    $favoris = $this->favorisService->create($data);

    return redirect()->back()->with('success', 'Product added to favorites successfully.');
}



    /**
     * Remove the specified resource from storage.
     */
    public function deleteFavoris( Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required',
        ]);
        $favoris=Favoris::where('product_id',$data['product_id'])->first();
        $this->favorisService->delete($favoris->id);

        return redirect()->back();
    }
}
