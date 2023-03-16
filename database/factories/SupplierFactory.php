<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_produk' => fake() -> numberBetween(1, 10),
            'nama_supplier' => fake('id_ID') -> company(),
            'alamat' => fake('id_ID') -> address(),
            'no_telp' => fake('id_ID') -> phoneNumber(),
            'id_admin' => fake() -> numberBetween(1, 10)
        ];
    }
}
