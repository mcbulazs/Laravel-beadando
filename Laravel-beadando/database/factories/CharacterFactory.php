<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Character>
 */
class CharacterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $output = [];
        $sum = 20;
        //the sum of all the stats must not exceed 20
        $output['name'] = $this->faker->name();
        $output['defence'] = $this->faker->numberBetween(0, 3);
        $sum -= $output['defence'];
        $output['strength'] = $this->faker->numberBetween(0, $sum);
        $sum -= $output['strength'];
        $output['accuracy'] = $this->faker->numberBetween(0, $sum);
        $sum -= $output['accuracy'];
        $output['magic'] = $this->faker->numberBetween(0, $sum);
        return $output;
    }
}
