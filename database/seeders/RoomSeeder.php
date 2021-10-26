<?php

namespace Database\Seeders;

use App\Models\Administration\Governorate;
use App\Models\Administration\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $govs = Governorate::all();

        foreach($govs as $gov) {
            $room = new Room([
                'name' => 'room-' . $gov->name
            ]);
            $gov->room()->associate($room);
            $gov->save();
            $room->save();
        }
    }
}
