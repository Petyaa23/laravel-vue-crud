<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        auth()->user();
        $products = Product::with('category')->get();
        return view('dashboard.admin-dashboard')->with(compact('products'));
    }
}
