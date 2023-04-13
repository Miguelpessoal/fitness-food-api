<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\{StoreProductsRequest, UpdateProductsRequest};
use App\Models\Product;
use App\Services\CreateProductService;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function __construct(protected CreateProductService $createProductService)
    {}

    public function index(): JsonResponse
    {
        $products = Product::paginate(10);

        return response()->json($products);
    }

    public function store(StoreProductsRequest $request): JsonResponse
    {
        try {
        $this->createProductService->run($request->file->getPathname());

        } catch (\Throwable $th) {
            throw new ApiException('', 201, ['Errors occurred! However, the correct data was properly saved.']);
        }

        return response()->json(['success' => true]);
    }

    public function show(string $id): JsonResponse
    {
        $product = Product::findOrFail($id);

        return response()->json($product);
    }

    public function update(UpdateProductsRequest $request, string $id): JsonResponse
    {
        try {
            $product = Product::find($id);
            $product->update($request->validated());
        } catch (\Throwable $th) {
            throw new ApiException('', 422, [$th->getMessage()]);
        }

        return response()->json(['success' => true]);
    }

    public function destroy(string $id): JsonResponse
    {
        $product = Product::findOrFail($id);
        $product->update(['status' => 'trash']);

        return response()->json(['success' => true]);
    }
}
