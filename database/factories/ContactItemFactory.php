<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactItem>
 */
class ContactItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'icon' => $this->faker->randomElement(['f095', 'f073', 'f0e0', 'f0ac']),
            'is_button' => false,
            'order' => $this->faker->numberBetween(-3, 3),

            'text' => $this->faker->randomElement([
                'Maak een afspraak',
                'Plan een belletje',
                'Bel ons',
                'Bekijk onze website',
                'Bezoek ons kantoor',
            ]),
            'url' => $this->faker->randomElement([
                'https://dutchcodingcompany.com/',
                'tel:+31407440889',
                'mailto:glenn@dutchcodingcompany.com',
                'https://calendly.com/glenn-bergmans/video',
            ]),
        ];
    }

    public function button(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_button' => true,
        ]);
    }

    public function order($num = 0): static
    {
        return $this->state(fn (array $attributes) => [
            'order' => $num,
        ]);
    }
}
