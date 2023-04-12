<?php

use App\Models\Product;

it('should be able to list products', function () {
    Product::factory()
        ->count(10)
        ->create();

    $this->get('/products')
        ->assertStatus(200)
        ->assertSee('Products');
});
