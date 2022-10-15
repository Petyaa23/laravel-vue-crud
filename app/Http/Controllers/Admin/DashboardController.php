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
    public function index(): View|Factory|Application
    {
        $products = Product::with('category')->paginate(5);
        return view('dashboard.admin-dashboard')->with(compact('products'));
    }

    /**
     * @param Request $request
     * @return void
     */

    public function changeStatus(Request $request): void
    {
        $productId = $request->input('id');
        $status = $request->input('status');
        Product::where('id', $productId)->update([
            'status' => $status
        ]);
    }

}
