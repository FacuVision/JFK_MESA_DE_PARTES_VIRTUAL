<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "lastname" => $this->faker->unique()->lastName(),
            "date_nac" => $this->faker->date(),
            "gender" => $this->faker->randomElement(["m","f"]),
            "address" => $this->faker->address(),
            "phone" => $this->faker->numerify('#########'),
            "document_number" => $this->faker->randomNumber(8)
        ];
    }
}
