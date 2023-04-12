<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => ['sometimes', 'integer'],
            'status' => ['nullable', 'string'],
            'imported_t' => ['nullable', 'date'],
            'url' => ['sometimes', 'string'],
            'creator' => ['sometimes', 'string'],
            'created_t' => ['sometimes', 'integer'],
            'last_modified_t' => ['sometimes', 'integer'],
            'product_name' => ['sometimes', 'string'],
            'quantity' => ['sometimes', 'string'],
            'brands' => ['sometimes', 'string'],
            'categories' => ['sometimes', 'string'],
            'labels' => ['sometimes', 'string'],
            'cities' => ['nullable', 'string'],
            'purchase_places' => ['sometimes', 'string'],
            'stores' => ['sometimes', 'string'],
            'ingredients_text' => ['sometimes', 'string'],
            'traces' => ['sometimes', 'string'],
            'serving_size' => ['sometimes', 'string'],
            'serving_quantity' => ['sometimes', 'numeric'],
            'nutriscore_score' => ['sometimes', 'numeric'],
            'nutriscore_grade' => ['sometimes', 'string'],
            'main_category' => ['sometimes', 'string'],
            'image_url' => ['sometimes', 'string'],
        ];
    }
}
