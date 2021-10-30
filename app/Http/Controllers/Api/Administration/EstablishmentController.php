<?php


namespace App\Http\Controllers\Api\Administration;


use App\Http\Controllers\Controller;
use App\Models\Administration\Establishment;
use App\Models\Administration\Sector;

class EstablishmentController extends Controller
{
    public function index(Sector $sector)
    {
        return $sector->establishments;
    }

    public function show(Establishment $establishment)
    {
        return $establishment;
    }
}
