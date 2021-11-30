<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\SportEvent;
use App\Models\Strava;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Class DatabaseSeeder
 *
 * @author Dzianis Kotau <me@dzianiskotau.com>
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            SportEventSeeder::class,
        ]);

        $this->eventUsers();
        $this->stravas();
        $this->admin();
    }

    /**
     * Pivot user_event table seeding
     *
     * @author Dzianis Kotau <me@dzianiskotau.com>
     */
    private function eventUsers(): void
    {
        foreach (User::all() as $user) {
            foreach (SportEvent::all() as $sportEvent) {
                if (rand(1, 100) > 50) {
                    $user->sportEvents()->attach($sportEvent->id);
                }
            }
            $user->save();
        }
    }

    /**
     * Seed strava table
     *
     * @author Dzianis Kotau <me@dzianiskotau.com>
     */
    private function stravas(): void
    {
        foreach (User::all('id') as $user) {
            if (rand(1, 100) < 50) {
                continue;
            }

            $strava = Strava::factory()->create();
            $strava->user_id = $user->id;
            $strava->save();
        }
    }

    private function admin(): void
    {
        User::factory()->create([
            'name' => config('sportify.super_admin_name'),
            'email' => config('sportify.super_admin_email'),
            'organization_id' => Organization::first('id')->id,
            'password' => Hash::make(config('sportify.super_admin_password')),
        ]);
    }
}
