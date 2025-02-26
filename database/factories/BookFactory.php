<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Book;
use App\Models\Author;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $authors = Author::all();
        return [
            'title' => $this->faker->sentence(3),
            'price' => $this->faker->randomFloat(2, 10, 50),
            'stock' => $this->faker->numberBetween(1, 100),
            'author_id' => $authors->random()->id,
        ];
    }
}
