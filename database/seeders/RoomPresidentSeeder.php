<?php

namespace Database\Seeders;

use App\AppRoles;
use App\Models\Administration\Room;
use App\Models\Role;
use App\Models\RoomPresident;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoomPresidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms = Room::all();
        $room = $rooms->get(0);
        $id = 1;
        $user = new User([
            'first_name' => 'amel',
            'last_name' => "charfedi",
            'password' => Hash::make('rootkit22'),
            'email' => "room-president-$id@zoomin.com",
        ]);
        $role = Role::query()->where('name', '=', AppRoles::ROLE_ROOM_PRESIDENT)->first();
        $user->save();
        $user->attachRole($role);
        $user->save();
        $roomPresident = new RoomPresident();
        $roomPresident->user()->associate($user);
        $roomPresident->save();

        $room->roomPresident()->associate($roomPresident);
        $room->save();
    }
}
