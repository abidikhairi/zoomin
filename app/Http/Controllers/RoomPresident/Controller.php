<?php


namespace App\Http\Controllers\RoomPresident;


use App\Models\RoomPresident;

class Controller extends \App\Http\Controllers\Controller
{
    public function roomPresident(): RoomPresident
    {
        return auth()->user()->roomPresident;
    }
}
