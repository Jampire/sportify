<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

/**
 * Class DepartmentSeeder
 *
 * @author Dzianis Kotau <me@dzianiskotau.com>
 */
class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @author Dzianis Kotau <me@dzianiskotau.com>
     * @return void
     */
    public function run()
    {
        Department::factory()
            ->count(10)
            ->create();
    }
}
