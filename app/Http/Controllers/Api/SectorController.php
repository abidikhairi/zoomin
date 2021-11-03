<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Administration\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    public function all()
    {
        return Sector::all();
    }
}
