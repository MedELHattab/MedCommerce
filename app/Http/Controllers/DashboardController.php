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

        $users = User::count();
        $categories = Category::count();
        $products = Product::count();
        $payments = Payment::count();

        return view('dashboard.dashboard', compact('users', 'categories', 'products', 'payments'));
    }
}