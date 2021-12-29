<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VendeurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'vd_name' => $this->faker->name,
            'salaire' => $this->faker->numerify('######.##')
        ];
    }
}
