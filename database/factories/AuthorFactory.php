<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Author;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nationalities = ['IT', 'FR', 'EN', 'DE', 'ES', 'PT', 'RU', 'CN', 'JP', 'US'];
        return [
            'firstname' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'nationality' => $nationalities[array_rand($nationalities)],
        ];
    }
}
