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
        $colors=Color::all();
        $sizes=Size::all();
        $user = Auth::user();
        $products = Product::whereHas('favoris', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();
        return view('favoris', compact('products','colors','sizes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'product_id' => 'required',
        ]);

        $data['user_id'] = auth()->id();


        $comment = $this->favorisService->create($data);

        return redirect()->back()->with('success', 'Product added to favoris successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $this->favorisService->delete($id); 

        return redirect()->back();
    }
}
