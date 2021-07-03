<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Administration\Governorate;

class GovernorateController extends Controller
{
    public function index()
    {
            return Governorate::all();
    }

    public function show(Governorate $governorate)
    {
        return $governorate;
    }
}
