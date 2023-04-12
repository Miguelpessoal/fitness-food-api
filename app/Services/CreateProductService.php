<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class CreateProductService
{
    public function run(object $request): void
    {
        $file = $request->file('file');
        $path = Storage::putFile('temp', $file);

        $content = Storage::get($path);
        $data = json_decode($content, true);

        foreach ($data as $product) {
            $product['status'] = 'draft';
            $product['imported_t'] = now();

            Product::create($product);
        }
    }
}
