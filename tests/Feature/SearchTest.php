<?php

use App\Models\Product;

it('should be able to find a data using search', function () {
    $product = Product::factory()->create();

    $response = $this->getJson('/api/search?search=' . $product->code);

    $response->assertOk();
    $response->assertJsonFragment([
        'code' => $product->code,
    ]);
});
