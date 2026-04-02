<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ComentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
             'user_id' => $this->faker->numberBetween(1,10),
             'item_id' => $this->faker->numberBetween(1,10),
             'content' => $this->faker->sentence,
            //
        ];
    }
}
