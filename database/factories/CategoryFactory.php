<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    public function configure(): static
    {
        return $this->afterCreating(function (Category $category) {
            $files = glob(__DIR__.'/data/gif/*.gif');
            if (filled($files)) {
                $category
                    ->addMedia($this->faker->randomElement($files))
                    ->preservingOriginal()
                    ->usingFileName('joke.gif')
                    ->toMediaCollection('gif');
            }

            $files = glob(__DIR__.'/data/icon/*.svg');
            if (filled($files)) {
                $category
                    ->addMedia($this->faker->randomElement($files))
                    ->preservingOriginal()
                    ->usingFileName('icon.svg')
                    ->toMediaCollection('icon');
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
            'icon' => $this->faker->randomElement(['f5d1', 'f818', 'f6c5', 'f805']),

            'name' => $this->faker->randomElement(['Pizza', 'Hamburgers', 'Koffie & Thee', 'Gezond']),
            'description' => $this->faker->optional()->text(200),
            'cta_title' => $this->faker->text(200),
            'cta_subtitle' => $this->faker->text(200),
        ];
    }
}
