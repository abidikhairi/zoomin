<?php

namespace Database\Seeders;

use App\AppRoles;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => AppRoles::ROLE_CITIZEN,
            'display_name' => ucfirst(AppRoles::ROLE_CITIZEN)
        ]);

        Role::create([
            'name' => AppRoles::ROLE_MAGISTRATE,
            'display_name' => ucfirst(AppRoles::ROLE_MAGISTRATE)
        ]);

        Role::create([
            'name' => AppRoles::ROLE_ROOM_PRESIDENT,
            'display_name' => ucfirst(AppRoles::ROLE_ROOM_PRESIDENT)
        ]);

        Role::create([
            'name' => AppRoles::ROLE_FIRST_PRESIDENT,
            'display_name' => ucfirst(AppRoles::ROLE_FIRST_PRESIDENT)
        ]);
    }
}
