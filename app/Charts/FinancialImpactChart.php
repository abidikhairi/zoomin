<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Administration\Sector;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinancialImpactChart extends BaseChart
{

    public ?string $name = 'financial_impact';
    public ?string $routeName = 'financial_impact';

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
        $labels = [];
        foreach (Sector::all('name') as $sector) {
            $labels[] = $sector->name;
        }
        $data = [];

        foreach ($labels as $label) {
            $data[] = DB::table('reports')
                ->join('sectors', 'sectors.id', '=', 'reports.sector_id')
                ->join('observations', 'observations.report_id', '=', 'reports.id')
                ->where('sectors.name', '=', $label)
                ->sum('observations.impact');
        }

        return Chartisan::build()
            ->labels($labels)
            ->dataset('القطاعات', $data);
    }
}
