<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Administration\Room;
use App\Models\Magistrate;
use Illuminate\Http\Request;

class MagistrateController extends Controller
{
    public function index()
    {
        return response()->json([
            'magistrates' => Magistrate::with('user')->get()
        ]);
    }

    public function magistrates(Room $room)
    {
        $magistrates = $room->magistrates()->with('user')->get();

        return response()->json(compact('magistrates'));
    }
}
