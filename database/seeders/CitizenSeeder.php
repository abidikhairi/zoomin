<?php

namespace Database\Seeders;

use App\AppRoles;
use App\Models\Citizen;
use App\Models\Citizen\Profile;
use App\Models\Role;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CitizenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('ar_AA');

        for ($i = 0; $i < 10; $i++) {
            $citizenRole = Role::query()->where('name', '=', AppRoles::ROLE_CITIZEN)->firstOrFail();
            $profile = Profile::query()->inRandomOrder()->first();

            $user = new User([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'password' => Hash::make('password'),
                'email' => "user-$i@example.com",
            ]);

            $user->save();
            $user->attachRole($citizenRole);

            $citizen = new Citizen([
                'telephone' => Str::random('8')
            ]);

            $citizen->user()->associate($user);
            $citizen->profile()->associate($profile);

            $citizen->save();
        }
    }
}
