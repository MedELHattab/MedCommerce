<?php

namespace App\Http\Controllers;
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

        
        return view('dashboard.dashboard');
    }
}