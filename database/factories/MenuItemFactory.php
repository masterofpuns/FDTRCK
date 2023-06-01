<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MenuItem>
 */
class MenuItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'price' => $this->faker->numberBetween(4, 20) / 4, // €1,00, €1,25, €1,50 ... €5,00
            'name' => $this->faker->randomElement(['Koffie', 'Cappuchino', 'Groene thee', 'Water', 'Vruchtensap']),
            'description' => $this->faker->optional()->text(200),
        ];
    }
}
