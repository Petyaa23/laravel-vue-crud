<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\AddProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        return view('dashboard.user-dashboard');
    }

    /**
     * @return JsonResponse
     */
    public function getCategories(): JsonResponse
    {
        $categories = Category::where('user_id', auth()->id())
            ->orderBy('id', 'DESC')
            ->paginate(5);
        return response()->json(['categories' => $categories]);
    }

    /**
     * @return JsonResponse
     */
    public function getProducts(): JsonResponse
    {
        $products = Product::where('user_id', auth()->id())
            ->with('category')
            ->orderBy('id', 'DESC')
            ->paginate(5);
        return response()->json(['products' => $products]);
    }

    /**
     * @return JsonResponse
     */
    public function getCategoryList(): JsonResponse
    {
        $categoryList = Category::where('user_id', auth()->id())->get();
        return response()->json(['category_list' => $categoryList]);
    }

    /**
     * @param AddProductRequest $request
     * @return JsonResponse
     */
    public function addProduct(AddProductRequest $request): JsonResponse
    {
        $product = Product::create(
            [
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'user_id' => auth()->id(),
                'category_id' => $request->input('category_id')
            ]
        );
        $product = Product::where('id', $product->id)
            ->with('category')
            ->first();
        return response()->json([
            'status' => 'success',
            'product' => $product
        ]);
    }

    /**
     * @param AddCategoryRequest $request
     * @return JsonResponse
     */
    public function addCategory(AddCategoryRequest $request): JsonResponse
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

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function destroyProduct(Request $request): JsonResponse
    {
        $id = $request->input('id');
        Product::find($id)->delete();
        $product = Product::orderBy('id', 'DESC')
            ->with('category')
            ->skip(
                $request->input('current_page') * 5 - 1)
            ->take(1)->first();
        return response()->json([
            'message' => 'Product successfully deleted!',
            'product' => $product]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function destroyCategory(Request $request): JsonResponse
    {
        $id = $request->input('id');
        Category::find($id)->delete();
        Product::where('category_id', $id)->delete();
        $category = Category::orderBy('id', 'desc')
            ->skip(
                $request->input('current_page') * 5 - 1)
            ->take(1)->first();
        return response()->json([
            'message' => 'Category deleted!',
            'category' => $category]);
    }

    /**
     * @param AddCategoryRequest $request
     * @return JsonResponse
     */
    public function updateCategory(AddCategoryRequest $request): JsonResponse
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

    /**
     * @param AddProductRequest $request
     * @return JsonResponse
     */
    public function updateProduct(AddProductRequest $request): JsonResponse
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

