<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Administration\Governorate;
use App\Models\Administration\Sector;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GovernorateChart extends BaseChart
{

    public ?string $name = 'chart_governorate';
    public ?string $routeName = 'chart_governorate';

    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     * @param Request $request
     * @return Chartisan
     * @throws \Exception
     */
    public function handler(Request $request): Chartisan
    {
        $governorate = Governorate::query()->where('id', '=', $request->get('governorate'))->firstOrFail();
        $labels = [];
        $data = [];

        foreach (Sector::all() as $sector) {
            $labels[] = $sector->name;
        }

        foreach ($labels as $label) {
            $data[] = DB::table('claims')
                ->join('sectors', 'sectors.id', '=', 'claims.sector_id')
                ->join('establishments', 'establishments.id', '=', 'claims.establishment_id')
                ->join('governorates', 'governorates.id', '=', 'establishments.governorate_id')
                ->where([
                    ['governorates.id', '=', $governorate->id],
                    ['sectors.name', '=', $label]
                ])
                ->count();
        }

        return Chartisan::build()
            ->labels($labels)
            ->dataset(__('names.claims.plural'), $data);
    }
}
