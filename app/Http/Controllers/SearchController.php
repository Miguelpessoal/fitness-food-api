<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class SearchController extends Controller
{
    public function __invoke(SearchRequest $request): JsonResponse
    {
        $filteredData = Product::query()
            ->where('code', 'like', "%{$request->search}%")
            ->orWhere('product_name', 'like', "%{$request->search}%")
            ->orWhere('cities', 'like', "%{$request->search}%")
            ->orWhere('status', 'like', "%{$request->search}%")
            ->orWhere('creator', 'like', "%{$request->search}%")
            ->orWhere('brands', 'like', "%{$request->search}%")
            ->get();

        return response()->json($filteredData);
    }
}
