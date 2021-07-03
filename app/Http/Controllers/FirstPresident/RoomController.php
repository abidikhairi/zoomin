<?php


namespace App\Http\Controllers\FirstPresident;


use App\Models\Administration\Room;
use App\Models\RoomPresident;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('first-president.room.index', compact('rooms'));
    }

    public function roomPresidentForm()
    {
        $presidents = RoomPresident::all();
        $rooms = Room::all();
        return view('first-president.room.room-form', compact('rooms', 'presidents'));
    }


    public function assignPresidentForm(Room $room)
    {
        $presidents = RoomPresident::all();
        return view('first-president.room.assign-president-form', compact('room', 'presidents'));
    }

    public function assignPresident(Request $request)
    {
        $this->validate($request, [
            'room_president' => 'required',
            'room' => 'required'
        ]);
        $room = Room::find($request->room);
        $roomPresident = RoomPresident::find($request->room_president);

        $room->roomPresident()->associate($roomPresident);
        $room->save();

        return redirect()->to($this->firstPresident()->user->account);
   }
}
