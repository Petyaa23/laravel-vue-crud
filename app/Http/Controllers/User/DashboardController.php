<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $category = Category::all();
        return view('dashboard.user-dashboard')->with(compact('products','category'));
}

public function store(Request $request)
{
    $product = Product::create($request->all());
    return response()->json([
        'status' => 'success',
        'product' => $product
    ]);
}

    public function destroy($id)
    {

        $product = Product::find($id);
        $product->delete();

        return response()->json('Product successfully deleted!');
    }

//public function show($id)
//{
//    $product = Product::find($id);
//
//    return response()->json($product);
//}
//
//public function update(Request $request, $id)
//{
//    $product = Product::find($id);
//    $product->update($request->all());
//
//    return response()->json([
//        'status' => 'success',
//        'post'   => $product
//    ]);
//}
//

}

