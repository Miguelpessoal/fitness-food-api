<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class CreateProductService
{
    public function run($path): void
    {
        $file = fopen($path, 'r');

        while (!feof($file)) {
            $line = fgets($file);
            $data = json_decode($line, true);
            $limitCreate = 0;

            if (!empty($data) && $limitCreate < 100) {
                $validateData = $this->rules($data);

                Product::create($validateData);
                $limitCreate++;
            }
        }

        fclose($file);
    }

    public function rules($data): array
    {
        $rules = [
            'code' => ['integer', 'unique:products,code'],
            'status' => ['nullable', 'string'],
            'imported_t' => ['nullable', 'date'],
            'url' => ['string'],
            'creator' => ['string'],
            'created_t' => ['integer'],
            'last_modified_t' => ['integer'],
            'product_name' => ['string'],
            'quantity' => ['string'],
            'brands' => ['string'],
            'categories' => ['string'],
            'labels' => ['string'],
            'cities' => ['nullable', 'string'],
            'purchase_places' => ['string'],
            'stores' => ['string'],
            'ingredients_text' => ['string'],
            'traces' => ['string'],
            'serving_size' => ['string'],
            'serving_quantity' => ['numeric'],
            'nutriscore_score' => ['numeric'],
            'nutriscore_grade' => ['string'],
            'main_category' => ['string'],
            'image_url' => ['string'],
        ];

        $validateData = Validator::make($data, $rules)->validate();

        return $validateData;
    }
}
