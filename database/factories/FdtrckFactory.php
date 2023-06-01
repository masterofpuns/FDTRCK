<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Fdtrck;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fdtrck>
 */
class FdtrckFactory extends Factory
{
    public function configure(): static
    {
        return $this->afterCreating(function (Fdtrck $fdtrck) {
            $files = glob(__DIR__.'/data/food/*.{jpeg,jpg,png}', GLOB_BRACE);

            if (filled($files)) {
                $fdtrck
                    ->addMedia($this->faker->randomElement($files))
                    ->preservingOriginal()
                    ->usingFileName('fdtrck.jpg')
                    ->toMediaCollection('main');
            }
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'phone' => $this->faker->optional(0.8)->e164PhoneNumber(),
            'lat' => $this->faker->latitude(50.5, 53.5),
            'lng' => $this->faker->longitude(4.0, 7.0),
            'review_score' => $this->faker->optional(0.7)->randomFloat(1, 3, 5),
            'review_count' => $this->faker->numberBetween(0, 100),

            'name' => $this->faker->randomElement(['Het Pannenkoekenhuis', 'Koffiehoekje', 'Burrito\'s en Bier', 'Burgers op Wielen']),
            'slogan' => $this->faker->sentence(),
            'description' => $this->faker->optional()->text(200),
        ];
    }
}
