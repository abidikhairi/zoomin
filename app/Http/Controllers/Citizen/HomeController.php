<?php

namespace App\Http\Controllers\Citizen;


class HomeController extends Controller
{

    public function home() {
        return view('citizen.home');
    }
}
