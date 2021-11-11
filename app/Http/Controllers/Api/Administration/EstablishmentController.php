<?php


namespace App\Http\Controllers\Api\Administration;


use App\Http\Controllers\Controller;
use App\Models\Administration\Establishment;
use App\Models\Administration\Governorate;
use App\Models\Administration\Sector;

class EstablishmentController extends Controller
{

    public function establishmentsBySector(Sector $sector)
    {
        return $sector->establishments()->get();
    }

    public function index(Governorate $governorate, Sector $sector)
    {
        return $sector->establishments()
            ->with('governorate')
            ->whereHas('governorate', function ($query) use ($governorate){
                return $query->where('id', '=', $governorate->id);
            })
            ->get();
    }

    public function show(Establishment $establishment)
    {
        return $establishment;
    }
}
