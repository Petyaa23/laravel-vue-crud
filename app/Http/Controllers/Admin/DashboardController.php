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

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $pages = 5;
        $products = Product::with('category')->paginate($pages)->items();
        $products = Product::with('category')->get();
//        $products = $products->paginate(2);
        return view('dashboard.admin-dashboard')->with(compact('products'));
    }

    public function changeStatus(Request $request)
    {
        $productId = $request->input('id');
        $status = $request->input('status');
        Product::where('id', $productId)->update([
            'status' => $status
        ]);
    }

}
