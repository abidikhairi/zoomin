<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Administration\Governorate;
use Carbon\Carbon;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MunicipalitiesNbObservations extends BaseChart
{
    public ?string $name = 'municipalities_count_observations';
    public ?string $routeName = 'municipalities_count_observations';

    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $governorate = Governorate::query()->where('id', '=', $request->get('governorate'))->firstOrFail();
        $labels = [];
        $data = [];

        for ($i = -5; $i < 0; $i++) {
            $labels[] = Carbon::now()->year + $i;
        }
        $chartisan = Chartisan::build()->labels($labels);
        $municipalities = $governorate->establishments->filter(fn ($e) => $e->is_municipality);

        foreach ($municipalities as $municipality) {
            $data = [];
            foreach ($labels as $label) {
                $data[] = DB::table('reports')
                    ->join('establishments', 'establishments.id', '=', 'reports.establishment_id')
                    ->join('observations', 'observations.report_id', '=', 'reports.id')
                    ->where([
                        ['establishments.id', '=', $municipality->id],
                        ['reports.year', '=', $label],
                    ])
                    ->count('observations.id');
            }
            $chartisan->dataset($municipality->name, $data);
        }
        foreach ($labels as $label) {
            $data[] = DB::table('reports')
                ->join('establishments', 'establishments.id', '=', 'reports.establishment_id')
                ->join('governorates', 'governorates.id', '=', 'establishments.governorate_id')
                ->join('observations', 'observations.report_id', '=', 'reports.id')
                ->where([
                    ['governorates.id', '=', $governorate->id],
                    ['reports.year', '=', $label],
                    ['establishments.is_municipality', '=', true]
                ])
                ->count('observations.id');
        }

        return $chartisan;
    }
}
