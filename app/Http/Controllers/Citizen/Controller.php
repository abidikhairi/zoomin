<?php


namespace App\Http\Controllers\Citizen;


use App\Models\Citizen;

class Controller extends \App\Http\Controllers\Controller
{
    public function citizen(): Citizen
    {
        return auth()->user()->citizen;
    }
}
