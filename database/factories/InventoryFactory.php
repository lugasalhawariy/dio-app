<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory>
 */
class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $products = Product::all();
        $faker_product = $this->faker->randomElement($products);

        return [
            'name' => $faker_product->name,
            'product_id' => $faker_product->id,
            'price' => $faker_product->price,
            'amount' => $this->faker->numberBetween(1, 100),
            'unit' => $this->faker->randomElement(['gram', 'liters', 'items']),
        ];
    }
}
