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
            'Juguetes educativos',
            'Peluches',
            'Juegos de construcción',
            'Muñecas y accesorios',
            'Vehículos de juguete',
            'Juegos de mesa',
            'Rompecabezas',
            'Juguetes electrónicos',
            'Juguetes para bebés',
            'Figuras de acción',
            'Disfraces',
            'Juguetes musicales',
            'Juguetes de exterior',
            'Artes y manualidades',
            'Juguetes científicos'
        ];

        return [
            'name' => $this->faker->unique()->randomElement($categoryNames),
            'description' => $this->faker->sentence(),
        ];
    }
}
