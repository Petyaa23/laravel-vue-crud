<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $loggedUser = auth()->user();
        $loggedUserId = $loggedUser->id;

        $products = Product::where('user_id', $loggedUserId)->get();
        $categories = Category::where('user_id', $loggedUserId)->get();
        return view('dashboard.user-dashboard')->with(compact('products','categories'));
}

public function store(Request $request)
{
    $loggedUser = auth()->user();
    $loggedUserId = $loggedUser->id;


    $product = Product::create(
        [
            'name' => $request['name'],
            'price' => $request['price'],
            'user_id' => $loggedUserId,
        ]

    );
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

    public function update(Request $request, $id)
{
    $product = Category::find($id);
    $product->update($request->all());
//$product = Category::where('id', $id)->update($request->all());
    return response()->json([
        'status' => 'success',
        'post'   => $product
    ]);




}





//public function show($id)
//{
//    $product = Product::find($id);
//
//    return response()->json($product);
//}
//

//
}

