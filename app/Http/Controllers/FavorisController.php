<?php

namespace App\Http\Controllers;


use App\Models\Favoris;
use Illuminate\Http\Request;

use App\Services\FavorisService;

class FavorisController extends Controller
{

    public function __construct(
        protected FavorisService $favorisService
    ) {
    }
    public function index()
    {
        $products = $this->favorisService->all(); 
        return view('faroris', compact('products'));
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
