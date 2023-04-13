<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\{StoreProductsRequest, UpdateProductsRequest};
use App\Models\Product;
use App\Services\CreateProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(protected CreateProductService $createProductService)
    {}

    public function index(): \Illuminate\Http\JsonResponse
    {
        $products = Product::paginate(10);

        return response()->json($products);
    }

    public function store(Request $request)
    {
        try {
            $this->createProductService->run($request->validated());
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

    public function update(UpdateProductsRequest $request, string $id)
    {
        try {
            $product = Product::find($id);
            $product->update($request->validated());
        } catch (\Throwable $th) {
            throw new ApiException('', 422, [$th->getMessage()]);
        }

        return response()->json(['success' => true]);
    }

    public function destroy(string $id): \Illuminate\Http\JsonResponse
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['success' => true]);
    }
}
