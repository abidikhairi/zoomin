<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Citizen\Claim;
use App\Models\RoomPresident;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClaimByEstablishmentChart extends BaseChart
{

    public ?string $name = 'claim_establishment_chart';
    public ?string $routeName = 'claim_establishment_chart';

    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     * @param Request $request
     * @return Chartisan
     */
    public function handler(Request $request): Chartisan
    {
        $roomPresident = RoomPresident::find($request->get('roomPresident'));
        $governorates = $roomPresident->room->governorates->map(function($g) { return $g->id;})->toArray();

        $result = Claim::query()
            ->join('establishments', 'establishments.id', '=', 'claims.establishment_id')
            ->join('governorates', 'governorates.id', '=', 'establishments.governorate_id')
            ->whereIn('governorates.id', $governorates)
            ->groupBy('establishments.id', 'establishments.name')
            ->select('establishments.id', 'establishments.name', DB::raw('count(*) as total'))
            ->get();

        $labels = $result->map(function ($elem) { return $elem->name; })->toArray();
        $data = $result->map(function($elem) { return $elem->total; })->toArray();

        return Chartisan::build()
            ->labels($labels)
            ->dataset(__('establishments'), $data);
    }
}
