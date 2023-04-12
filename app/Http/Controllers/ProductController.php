<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\StoreProductsRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $products = Product::all();

        return response()->json($products);
    }

    public function store(
        StoreProductsRequest $request
    ): \Illuminate\Http\JsonResponse {
        try {
            $data = $request->validated();

            Product::create($data);
        } catch (\Throwable $th) {
            throw new ApiException('', 422, [$th->getMessage()]);
        }

        return response()->json(['success' => true]);
    }

    public function show(string $id): \Illuminate\Http\JsonResponse
    {
        $product = Product::findOrFail($id);

        return response()->json($product);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id): \Illuminate\Http\JsonResponse
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['success' => true]);
    }
}
