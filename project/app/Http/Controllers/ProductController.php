<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::select('id', 'name', 'description', 'price')->get();
        return response()->json($products);
    }
}