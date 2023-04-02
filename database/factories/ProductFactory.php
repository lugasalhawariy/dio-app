<?php

namespace Database\Factories;

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
    public function definition(): array
    {
        $variants = collect([]);
        for ($i = 0; $i < 3; $i++) {
            $variants->push([
                'name' => $this->faker->word,
                'additional_price' => $this->faker->numberBetween(100000, 1000000),
            ]);
        }

        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'price' => $this->faker->numberBetween(100000, 1000000),
            'variants' => $variants->toJson(),
        ];
    }
}
