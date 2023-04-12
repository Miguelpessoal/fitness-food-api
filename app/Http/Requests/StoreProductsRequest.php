<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => ['required', 'integer'],
            'status' => ['required', 'string', 'in: draft,trash,published'],
            'imported_t' => ['required', 'date'],
            'url' => ['required', 'string'],
            'creator' => ['required', 'string'],
            'created_t' => ['required', 'integer'],
            'last_modified_t' => ['required', 'integer'],
            'product_name' => ['required', 'string'],
            'quantity' => ['required', 'string'],
            'brands' => ['required', 'string'],
            'categories' => ['required', 'string'],
            'labels' => ['required', 'string'],
            'cities' => ['nullable', 'string'],
            'purchase_places' => ['required', 'string'],
            'stores' => ['required', 'string'],
            'ingredients_text' => ['required', 'string'],
            'traces' => ['required', 'string'],
            'serving_size' => ['required', 'string'],
            'serving_quantity' => ['required', 'numeric'],
            'nutriscore_score' => ['required', 'numeric'],
            'nutriscore_grade' => ['required', 'string'],
            'main_category' => ['required', 'string'],
            'image_url' => ['required', 'string'],
        ];
    }
}
