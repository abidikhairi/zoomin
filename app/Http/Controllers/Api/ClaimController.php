<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Administration\Governorate;
use App\Models\Citizen\Claim;
use App\Models\RoomPresident;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ClaimController extends Controller
{

    public function governorate(int $governorate)
    {
        return [
            'claims' => Claim::with('sector', 'establishment')->get(),
            'governorate' => Governorate::find($governorate)
        ];
    }
}
