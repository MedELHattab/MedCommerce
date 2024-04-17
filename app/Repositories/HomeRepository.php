<?php

namespace App\Repositories;
use Illuminate\Support\Facades\Session;



use App\Models\Product;

class HomeRepository implements HomeRepositoryInterface
{
    public function all()
    {
        return Product::all();
    }
}