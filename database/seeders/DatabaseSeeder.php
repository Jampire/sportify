<?php

namespace Database\Seeders;

use App;
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
    private const UNKNOWN_COMPANY = 'Unknown Company';

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $defaultOrgId = $this->defaultOrganization();
        $this->admin($defaultOrgId);

        if (App::environment('production')) {
            return;
        }

        $this->call([
            UserSeeder::class,
            SportEventSeeder::class,
        ]);

        $this->eventUsers();
        $this->stravas();
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

            Strava::factory([
                'user_id' => $user->id,
            ])->create();
        }
    }

    /**
     * Seeds super admin
     *
     * @param int $organizationId
     * @author Dzianis Kotau <me@dzianiskotau.com>
     */
    private function admin(int $organizationId): void
    {
        User::factory()->create([
            'name' => config('sportify.super_admin_name'),
            'email' => config('sportify.super_admin_email'),
            'organization_id' => $organizationId,
            'password' => Hash::make(config('sportify.super_admin_password')),
        ]);
    }

    /**
     * Seeds default 'unknown' organization
     *
     * @author Dzianis Kotau <me@dzianiskotau.com>
     * @return int ID of new organization
     */
    private function defaultOrganization(): int
    {
        return Organization::factory([
            'name' => self::UNKNOWN_COMPANY,
            'description' => self::UNKNOWN_COMPANY,
            'url' => null,
            'email_domain' => 'gmail.com',
        ])->create()->id;
    }
}
