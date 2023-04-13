<?php

namespace App\Services;

use App\Models\Product;

class CreateProductService
{
    public function run($path): void
    {
        $file = fopen($path, 'r');

        while (!feof($file)) {
            $line = fgets($file);
            $data = json_decode($line, true);

            $data['status'] = 'draft';
            $data['imported_t'] = now();

            Product::create($data);
        }

        fclose($file);
    }
}
