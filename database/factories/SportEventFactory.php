<?php

namespace Database\Factories;

use App\Models\SportEvent;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * Class SportEventFactory
 *
 * @author Dzianis Kotau <me@dzianiskotau.com>
 */
class SportEventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SportEvent::class;

    /**
     * Define the model's default state.
     *
     * @author Dzianis Kotau <me@dzianiskotau.com>
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'start_date' => now(),
            'end_date' => $this->faker->dateTimeBetween('+1 week', '+2 years'),
        ];
    }

    /**
     * @param Carbon $date
     * @author Dzianis Kotau <me@dzianiskotau.com>
     * @return Factory
     */
    public function startDate(Carbon $date): Factory
    {
        return $this->state(fn() => ['start_date' => $date]);
    }

    /**
     * @param Carbon $date
     * @author Dzianis Kotau <me@dzianiskotau.com>
     * @return Factory
     */
    public function endDate(Carbon $date): Factory
    {
        return $this->state(fn() => ['end_date' => $date]);
    }

    /**
     * @param bool $isSuspended
     * @author Dzianis Kotau <me@dzianiskotau.com>
     * @return Factory
     */
    public function suspended(bool $isSuspended = true): Factory
    {
        return $this->state(fn() => ['suspended' => $isSuspended]);
    }
}
