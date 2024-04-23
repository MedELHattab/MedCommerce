<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Gate;



class DashboardController extends Controller{

    // public function __construct()
    // {
    //     $this->middleware('isAdmin');
    // }

    public function index(){

        if (! Gate::allows('isAdmin')) {
            abort(403);
        }

        $usersCount = User::count();
        $categoriesCount = Category::count();
        $productsCount = Product::count();
        $paymentsCount = Payment::count();

        $products= Product::latest()->paginate(6);
        $categories=Category::latest()->paginate(3);
        $payments=Payment::latest()->paginate(6);

        

        return view('dashboard.dashboard', compact('usersCount', 'categoriesCount', 'productsCount', 'paymentsCount','products','categories','payments'));
    }
}