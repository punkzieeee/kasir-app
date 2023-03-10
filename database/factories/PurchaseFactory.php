<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Purchase>
 */
class PurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_produk' => fake()->numberBetween(1, 10),
            'id_supplier' => fake()->numberBetween(1, 10),
            'stok_masuk' => fake()->numberBetween(1, 10)
        ];
    }
}
