<?php

namespace Database\Factories;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class OrganizationFactory
 *
 * @author Dzianis Kotau <me@dzianiskotau.com>
 */
class OrganizationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Organization::class;

    /**
     * Define the model's default state.
     *
     * @author Dzianis Kotau <me@dzianiskotau.com>
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->company(),
            'description' => $this->faker->sentence(),
            'url' => $this->faker->url,
        ];
    }
}
