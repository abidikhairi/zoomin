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
        $govs = ['الكاف', 'سليانة', 'باجة', 'جندوبة'];
        $room = Room::create([
            'name' => 'room-1'
        ]);

        $g = [];
        foreach ($govs as $name) {
            $g[] = Governorate::query()->where('name', '=', $name)->firstOrFail();
        }

        $room->governorates()->saveMany($g);
    }
}
