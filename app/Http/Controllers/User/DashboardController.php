<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\AddProductRequest;
use App\Models\Category;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.user-dashboard');
    }

    public function getCategories()
    {
        $categories = Category::where('user_id', auth()->id())
            ->orderBy('id', 'DESC')
            ->paginate(5);
        return response()->json(['categories' => $categories]);

    }

    public function getProducts()
    {
        $products = Product::where('user_id', auth()->id())
            ->with('category')
            ->orderBy('id', 'DESC')
            ->paginate(5);
        return response()->json(['products' => $products]);
    }


    public function getCategoryList()
    {
        $categoryList = Category::where('user_id', auth()->id())->get();
        return response()->json(['category_list' => $categoryList]);
    }

    public function addProduct(AddProductRequest $request)
    {
        $product = Product::create(
            [
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'user_id' => auth()->id(),
                'category_id' => $request->input('category_id')
            ]
        );
        $product = Product::where('id', $product->id)->with('category')->first();
        return response()->json([
            'status' => 'success',
            'product' => $product
        ]);
    }

    public function addCategory(AddCategoryRequest $request)
    {
        $category = Category::create(
            [
                'name' => $request->input('name'),
                'description' => $request->input('description'),
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

    public function updateCategory(AddCategoryRequest $request)
    {
        $id = $request->input('id');
        $category = Category::where('id', $id)->update(
            [
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ]
        );
        return response()->json([
            'status' => 'success',
            'post' => $category
        ]);
    }

    public function updateProduct(AddProductRequest $request)
    {
        $id = $request->input('id');
        $product = Product::where('id', $id)->update(
            [
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'category_id' => $request->input('category_id')
            ]
        );
        $product = Product::where('id', $id)->with('category')->first();
        return response()->json([
            'status' => 'success',
            'product' => $product
        ]);
    }
}

