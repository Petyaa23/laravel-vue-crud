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
        $categories = Category::all();
        return view('dashboard.user-dashboard')->with(compact('products','categories'));
}

public function store(Request $request)
{
    $product = Product::create($request->all());
    return response()->json([
        'status' => 'success',
        'product' => $product
    ]);
}

public function add(Request $request)
{
    $category = Category::create($request->all());
    return response()->json([
        'status' => 'success',
        'category' => $category
    ]);
}
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json('Product successfully deleted!');
    }

    public function destroycategory($id)
    {
        $category = Category::find($id);
        $category->delete();
        return response()->json('Category successfully deleted!');
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

