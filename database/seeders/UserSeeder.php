<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * CLass UserSeeder
 *
 * @author Dzianis Kotau <me@dzianiskotau.com>
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @author Dzianis Kotau <me@dzianiskotau.com>
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(10)
            ->create();

        User::factory()
            ->count(10)
            ->unverified()
            ->create();

        User::factory()
            ->count(10)
            ->department()
            ->create();
    }
}
