<?php

namespace Database\Seeders;

use App\AppRoles;
use App\Models\Administration\Room;
use App\Models\Magistrate;
use App\Models\Role;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MagistrateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Magistrate::query()->delete();
        $faker = Factory::create('ar_AR');
        $rooms = Room::all();
        for ($i = 0; $i < 4; $i++) {
            $room = $rooms->get($i);
            for ($j = 0; $j < 6; $j++) {
                $id = $i+$j;
                $first_name = $faker->unique()->firstName;
                $last_name = $faker->unique()->lastName;
                $user = new User([
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'password' => Hash::make('rootkit22'),
                    'email' => "{$first_name}.{$last_name}@zoomin.com",
                ]);
                $role = Role::query()->where('name', '=', AppRoles::ROLE_MAGISTRATE)->first();
                $user->save();
                $user->attachRole($role);
                $user->save();
                $magistrate = new Magistrate();
                $magistrate->user()->associate($user);
                $magistrate->room()->associate($room);
                $magistrate->save();
            }
        }
    }
}
