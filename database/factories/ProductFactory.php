<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'slug' => $this->faker->word . now()->format('YmdHis'),
            'description' => $this->faker->sentence,
            'image' => 0,
            'quantity' => $this->faker->numberBetween(0, 10),
            'price' => $this->faker->randomFloat(1, 100, 1000),
            'category_id' => Category::all()->random()->id,
        ];
    }
}
