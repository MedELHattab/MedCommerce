<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Services\HomeService; 
use Illuminate\Http\Request;
use App\Models\Product; 
use App\Models\Size;

class HomeController extends Controller
{
    public function __construct(
      protected HomeService $homeService 
    ) {
    }

    public function index()
    {
       $sizes=Size::all();
       $colors=Color::all();
        $products = $this->homeService->all(); 
        return view('home', compact('products','colors','sizes'));
    }

    public function getAllproducts(){
      $sizes=Size::all();
       $colors=Color::all();
        $products = Product::latest()->paginate(10); 
        return view('Allproducts', compact('products','colors','sizes'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

  }