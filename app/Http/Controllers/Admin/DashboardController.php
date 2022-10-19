<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{


    public function index()
    {
        $products = Product::with('category')->paginate(5);
        return view('dashboard.admin-dashboard')->with(compact('products'));
    }

    public function changeStatus(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');
        Product::where('id', $id)->update(['status' => $status]);
        return response()->json('The Product successfully changed.');

    }

}
