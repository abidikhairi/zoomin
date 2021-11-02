<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Administration\Governorate;
use App\Models\Administration\Sector;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinancialImpactPerGovernorate extends BaseChart
{
    public ?string $name = 'financial_impact_per_governorate';
    public ?string $routeName = 'financial_impact_per_governorate';

    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $governorate = Governorate::query()->where('id', '=', $request->get('governorate'))->firstOrFail();
        $labels = [];
        foreach (Sector::all() as $sector) {
            $labels[] = $sector->name;
        }

        $data = [];
        foreach ($labels as $label) {
            $data[] = DB::table('reports')
                ->join('sectors', 'sectors.id', '=', 'reports.sector_id')
                ->join('observations', 'observations.report_id', '=', 'reports.id')
                ->join('establishments', 'establishments.id', '=', 'reports.establishment_id')
                ->join('governorates', 'governorates.id', '=', 'establishments.governorate_id')
                ->where([
                    ['governorates.id', '=', $governorate->id],
                    ['sectors.name', '=', $label]
                ])
                ->sum('observations.impact');
        }

        return Chartisan::build()
            ->labels($labels)
            ->dataset('Sample 2', $data);
    }
}
