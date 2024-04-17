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
        //the sum of all the stats must be 20
        $output['name'] = $this->faker->name();
        $output['enemy'] = $this->faker->boolean();
        $output['defence'] = $this->faker->numberBetween(0, 4);
        $sum -= $output['defence'];
        $output['strength'] = $this->faker->numberBetween(0, $sum);
        $sum -= $output['strength'];
        $sum = $sum < 0 ? 0 : $sum;
        $output['accuracy'] = $this->faker->numberBetween(0, $sum);
        $sum -= $output['accuracy'];
        $sum = $sum < 0 ? 0 : $sum;
        $output['magic'] = $this->faker->numberBetween(0, $sum);
        return $output;
    }
}
