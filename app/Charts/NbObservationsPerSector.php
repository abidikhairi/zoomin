<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Administration\Sector;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NbObservationsPerSector extends BaseChart
{

    public ?string $name = 'nb_observation_sector';
    public ?string $routeName = 'nb_observation_sector';
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $labels = [];
        $data = [];

        foreach (Sector::all() as $sector) {
            $labels[] = $sector->name;
        }

        foreach ($labels as $label) {
            $data[] = DB::table('reports')
                ->join('sectors', 'sectors.id', '=', 'reports.sector_id')
                ->join('observations', 'observations.report_id', '=', 'reports.id')
                ->where('sectors.name', '=', $label)
                ->count('observations.id');
        }

        return Chartisan::build()
            ->labels($labels)
            ->dataset('Sample 2', $data);
    }
}
