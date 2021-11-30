<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;

/**
 * Class OrganizationSeeder
 *
 * @author Dzianis Kotau <me@dzianiskotau.com>
 */
class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @author Dzianis Kotau <me@dzianiskotau.com>
     * @return void
     */
    public function run()
    {
        Organization::factory()
            ->count(10)
            ->create();
    }
}
