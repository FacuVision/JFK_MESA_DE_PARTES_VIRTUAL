<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class Type_procedingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->unique()->name,
            "description" => $this->faker->unique()->sentence(10),
            "type" => $this->faker->randomElement(['system', 'user'])
        ];
    }
}
