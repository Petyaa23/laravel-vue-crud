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
        auth()->user();
        $products = Product::where('user_id', auth()->id())->with('category')->get();
        $categories = Category::where('user_id', auth()->id())->get();
        return view('dashboard.user-dashboard')->with(compact('products','categories'));
    }

public function addProduct(Request $request)
    {
        $product = Product::create(
        [
            'name' => $request->input('name'),
            'price' => $request['price'],
            'user_id' => auth()->id(),
            'category_id' => $request->input('category_id')
        ]
    );
    return response()->json([
        'status' => 'success',
        'product' => $product
    ]);
    }

public function addCategory(Request $request)
    {
     $category = Category::create(
        [
            'name' => $request['name'],
            'description' => $request['description'],
            'user_id' => auth()->id(),
        ]
    );
    return response()->json([
        'status' => 'success',
        'category' => $category
    ]);
    }

    public function destroyProduct($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json('Product successfully deleted!');
    }

    public function destroyCategory($id)
    {
        $category = Category::find($id);
        $category->delete();
        return response()->json('Category successfully deleted!');
    }

    public function updateCategory(Request $request, $id)
    {
        $category = Category::where('id', $id)->update(
            [
            'name' => $request['name'],
            'description' => $request['description'],
            ]
        );
    return response()->json([
        'status' => 'success',
        'post'   => $category
    ]);
}

    public function updateProduct(Request $request)
    {
        $id = $request->input('id');
        $product = Product::where('id', $id)->update(
            [
                'name' => $request->input('name'),
                'price' => $request['price'],
            ]
        );
        return response()->json([
            'status' => 'success',
            'post' => $product
        ]);
    }
}

