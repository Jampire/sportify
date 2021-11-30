<?php

namespace Database\Seeders;

use App\Models\SportEvent;
use Illuminate\Database\Seeder;

/**
 * Class SportEventSeeder
 *
 * @author Dzianis Kotau <me@dzianiskotau.com>
 */
class SportEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @author Dzianis Kotau <me@dzianiskotau.com>
     * @return void
     */
    public function run()
    {
        SportEvent::factory()
            ->count(10)
            ->create();

        SportEvent::factory()
            ->count(10)
            ->suspended()
            ->create();

        SportEvent::factory()
            ->count(10)
            ->startDate(now()->subMonth())
            ->endDate(now()->subDays(2))
            ->create();
    }
}
