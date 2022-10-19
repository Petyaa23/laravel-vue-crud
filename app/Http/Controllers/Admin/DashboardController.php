<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{


    public function index()
    {
        $products = Product::with('category')->paginate(5);
        return view('dashboard.admin-dashboard')->with(compact('products'));
    }



//    public function changeStatus(Request $request): void
//    {
//
//        $productId = $request->input('id');
//        $status = $request->input('status');
//        Product::where('id', $productId)->update([
//            'status' => $status
//        ]);
//    }

    public function changeStatus(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');
        Product::where('id', $id)->update(['status' => $status]);
        return response()->json('The Product successfully changed.');

    }

}
