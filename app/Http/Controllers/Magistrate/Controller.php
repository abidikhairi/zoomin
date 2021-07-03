<?php


namespace App\Http\Controllers\Magistrate;


use App\Models\Magistrate;

class Controller extends \App\Http\Controllers\Controller
{
    public function magistrate(): Magistrate
    {
        return auth()->user()->magistrate;
    }
}
