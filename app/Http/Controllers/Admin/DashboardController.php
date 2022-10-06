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
     * @return Application|Factory|View+
     */
    public function index()
    {
        auth()->user();
        $products = Product::with('category')->get();
        return view('dashboard.admin-dashboard')->with(compact('products'));
    }

    public function changeStatus(Request $request) {
        dd($request->all());
        $productId = $request->input('id');
        $status = $request->input('status');
        Product::where('id', $productId)->update([
            'status' => $status
        ]);
    }




}
