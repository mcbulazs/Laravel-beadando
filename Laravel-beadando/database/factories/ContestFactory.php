<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contest>
 */
class ContestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $history = '';
        $herohp = 20;
        $enemyhp = 20;
        while ($herohp > 0 && $enemyhp > 0) { //not matching with actual result, but kinda valid data
            if ($this->faker->boolean()) {
                $dmg = $this->faker->numberBetween(1, 5);
                $enemyhp -= $dmg;
                $history .= '~Hero does ' . $dmg . 'dmg; Enemy has ' . $enemyhp . 'hp';
            } else {
                $dmg = $this->faker->numberBetween(1, 5);
                $herohp -= $dmg;
                $history .= '~Enemy does ' . $dmg . 'dmg; Hero has ' . $herohp . 'hp';
            }
        }
        return [
            'win' => $this->faker->optional(0.75)->boolean(),
            'history' => $history, //TODO: have to think about this one
        ];
    }
}
