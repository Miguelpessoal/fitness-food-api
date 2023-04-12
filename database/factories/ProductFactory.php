<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->randomNumber(8),
            'status' => $this->faker->randomElement([
                'draft',
                'published',
                'trash',
            ]),
            'imported_t' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'url' => $this->faker->url(),
            'creator' => $this->faker->name(),
            'created_t' => $this->faker->unixTime(),
            'last_modified_t' => $this->faker->unixTime(),
            'product_name' => $this->faker->name(),
            'quantity' => $this->faker->name(),
            'brands' => $this->faker->name(),
            'categories' => $this->faker->name(),
            'labels' => $this->faker->name(),
            'cities' => $this->faker->city(),
            'purchase_places' => $this->faker->name(),
            'stores' => $this->faker->name(),
            'ingredients_text' => $this->faker->name(),
            'traces' => $this->faker->name(),
            'serving_size',
            'serving_quantity' => $this->faker->randomFloat(2, 0, 1000),
            'nutriscore_score' => $this->faker->randomFloat(2, 0, 1000),
            'nutriscore_grade' => $this->faker->randomElement([
                'a',
                'b',
                'c',
                'd',
                'e',
            ]),
            'main_category' => $this->faker->name(),
            'image_url' => $this->faker->imageUrl(),
        ];
    }
}
