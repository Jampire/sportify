<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Classs KomootFactory
 *
 * @author Dzianis Kotau <me@dzianiskotau.com>
 */
class KomootFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @author Dzianis Kotau <me@dzianiskotau.com>
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'profile_id' => $this->faker->randomNumber(),
        ];
    }
}
