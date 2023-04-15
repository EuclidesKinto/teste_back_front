<?php

namespace Database\Factories;

use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Budget>
 */
class BudgetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client' => $this->faker->name,
            'description' => $this->faker->paragraph(1),
            'price' => $this->faker->numberBetween($min = 0, $max = 100),
            'seller_id' => Seller::factory()->create()->id,
            'created_at' => $this->faker->dateTimeBetween('-30 days', 'now')
        ];
    }
}
