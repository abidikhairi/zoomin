<?php


namespace App\Http\Controllers\FirstPresident;


use App\Models\FirstPresident;

class Controller extends \App\Http\Controllers\Controller
{
    public function firstPresident(): FirstPresident
    {
        return auth()->user()->firstPresident;
    }
}
