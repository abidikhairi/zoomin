<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(AdminSeeder::class);
        $this->call(GovernorateSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(RoomSeeder::class);
        $this->call(MagistrateSeeder::class);
        $this->call(RoomPresidentSeeder::class);
        $this->call(ProfileSeeder::class);

        Team::create([
            'name' => 'magistrates'
        ]);

        Team::create([
            'name' => 'G-24'
        ]);
    }
}
