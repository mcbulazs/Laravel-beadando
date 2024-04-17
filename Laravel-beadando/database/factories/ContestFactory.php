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
        return [
            'win' => $this->faker->boolean() ? $this->faker->boolean() : null, // i know its weird but it is what it is
            'history' => $this->faker->text(), //TODO: have to think about this one
        ];
    }
}
