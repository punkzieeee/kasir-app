<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $level = ['silver', 'gold', 'platinum'];
        return [
            'nama' => fake('id_ID') -> name(),
            'alamat' => fake('id_ID') -> address(),
            'no_telp' => fake('id_ID') -> phoneNumber(),
            'loyalty_level' => $level[fake() -> numberBetween(0, sizeof($level)-1)],
            'id_admin' => fake() -> numberBetween(1, 10)
        ];
    }
}
