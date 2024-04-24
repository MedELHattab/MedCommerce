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
       $categories=Category::all();
        $products = Product::latest()->paginate(10); 
        return view('Allproducts', compact('products','categories','colors','sizes'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function  search(Request $request){
      if($request->category){
         $products = Product::with("category")->where("name","like",'%'.$request->search_string.'%')->Where("category_id",$request->category)->get();
 
     }else $products = Product::with("category")->where("name","like",'%'.$request->search_string.'%')->get();
 
     if($products->count()) return response()->json([
         "status" => true
         ,
         "products" => $products
         ,
         "token"  => $request->header("X-CSRF-TOKEN")
     ]);
     else  return response()->json([
         "status" => false
     ]);
     }

  }