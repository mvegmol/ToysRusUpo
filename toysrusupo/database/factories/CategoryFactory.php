<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $categoryNames = [
            'Educational Toys',
            'Stuffed Animals',
            'Building Sets',
            'Dolls and Accessories',
            'Toy Vehicles',
            'Board Games',
            'Puzzles',
            'Electronic Toys',
            'Baby Toys',
            'Action Figures',
            'Costumes',
            'Musical Toys',
            'Outdoor Toys',
            'Arts and Crafts',
            'Scientific Toys'
        ];


        return [
            'name' => $this->faker->unique()->randomElement($categoryNames),
            'description' => $this->faker->sentence(),
        ];
    }
}
