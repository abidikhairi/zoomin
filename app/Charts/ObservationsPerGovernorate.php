<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Administration\Governorate;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ObservationsPerGovernorate extends BaseChart
{
    public ?string $name = 'observations_governorate';
    public ?string $routeName = 'observations_governorate';

    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $governorate = Governorate::query()->where('id', '=', $request->get('governorate'))->firstOrFail();

        $municipalities = DB::table('establishments')
            ->join('governorates', 'governorates.id', '=', 'establishments.governorate_id')
            ->where([
                ['is_municipality', '=', true],
                ['governorates.id', '=', $governorate->id]
            ])
            ->select('establishments.name', 'establishments.id')
            ->get();

        $labels = [];
        $data = [];

        foreach ($municipalities as $municipality) {
            $labels[] = $municipality->name;
        }

        foreach ($labels as $label) {
            $data[] = DB::table('establishments')
                ->join('governorates', 'governorates.id', '=', 'establishments.governorate_id')
                ->join('reports', 'reports.establishment_id', '=', 'establishments.id')
                ->join('observations', 'observations.report_id', '=', 'reports.id')
                ->where('establishments.name', '=', $label)
                ->count();
        }

        return Chartisan::build()
            ->labels($labels)
            ->dataset('observations', $data);
    }
}
