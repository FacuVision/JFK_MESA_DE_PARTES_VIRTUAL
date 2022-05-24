<?php

namespace Database\Factories;

use App\Models\Aplicant;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Type_proceding;

class ProcedingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "code" => $this->faker->postcode(),
            "title" => $this->faker->unique()->word(),
            "content" => $this->faker->unique()->word(),
            "n_foly" => $this->faker->randomElement(["1","2","9","15","3","5","10","7"]),
            "reference" => "-",
            "status" => "1",
            "office_id" => 1,
            "user_id" => $this->faker->randomElement([2,3,4,5,6,8]),
            "type_proceding_id" => Type_proceding::all()->random()->id
        ];
    }
}
