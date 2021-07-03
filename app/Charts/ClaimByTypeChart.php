<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Citizen\Claim;
use App\Models\Citizen\ClaimType;
use App\Models\RoomPresident;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class ClaimByTypeChart extends BaseChart
{

    public ?string $name = 'claim_type_chart';
    public ?string $routeName = 'claim_type_chart';

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
            ->join('claim_types', 'claim_types.id', '=', 'claims.claim_type_id')
            ->whereIn('governorates.id', $governorates)
            ->get();

        $labels = ClaimType::all()->map(function ($type) { return $type->name; })->toArray();
        $data = [];

        foreach ($labels as $type) {
            $data[] = $result->filter(function ($claim) use ($type) { return $claim->claimType->name === $type; })->count();
        }

        return Chartisan::build()
            ->labels($labels)
            ->dataset(__('names.claims-types'), $data);
    }
}
