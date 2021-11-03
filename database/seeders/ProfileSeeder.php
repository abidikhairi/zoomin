<?php

namespace Database\Seeders;

use App\Models\Citizen\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profiles = [
            [
                'name' => 'Citoyen',
                'priority' => 1
            ],
            [
                'name' => 'Fonctionnaire',
                'priority' => 2
            ],
            [
                'name' => 'Maire',
                'priority' => 3
            ]
        ];

        foreach ($profiles as $profile) {
            Profile::create([
                'name' => $profile['name'],
                'priority' => $profile['priority']
            ]);
        }
    }
}
