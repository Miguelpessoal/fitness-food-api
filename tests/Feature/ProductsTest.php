<?php

use App\Models\Product;

it('should be able to list products', function () {
    Product::factory()
        ->count(10)
        ->create();

    $response = $this->get('api/products');
    $response->assertStatus(200);

    expect($response->json()['total'])->toBe(10);
});

it('should be able to update a product', function () {
    $product = Product::factory()->create();

    $response = $this->put("api/products/{$product->id}", [
        'code' => 232543125,
    ]);

    $response->assertStatus(200);
    $response->assertJson([
        'success' => true,
    ]);

    $updatedProduct = Product::query()
        ->where('code', 232543125)
        ->first();

    $this->assertNotNull($updatedProduct);
});

it('should be able to delete a product', function () {
    $product = Product::factory()->create();

    $this->delete("api/products/{$product->id}");

    $deletedProduct = Product::query()
        ->where('id', $product->id)
        ->first();

    $this->assertNull($deletedProduct);
});

it('should be able to show a product', function () {
    $product = Product::factory()->create();

    $response = $this->get("api/products/{$product->id}");

    $response->assertStatus(200);
    $response->assertJson([
        'id' => $product->id,
        'code' => $product->code,
    ]);
});
