<?php

namespace App\Http\Controllers\RoomPresident;

use App\Http\Controllers\Controller;
use App\Models\Citizen\Response;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function show(Response $response)
    {
        return view('room-president.response.show', compact('response'));
    }
}
