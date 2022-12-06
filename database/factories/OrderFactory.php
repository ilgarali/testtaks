<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'bond_id'                => rand(1, 10),
            'order_date'             => Carbon::now()->addDays(rand(20, 100)),
            'number_of_bonds_bought' => rand(3, 33),
        ];
    }
}
