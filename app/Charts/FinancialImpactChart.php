<?php

declare(strict_types = 1);

namespace App\Charts;

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
     */
    public function handler(Request $request): Chartisan
    {
        return Chartisan::build()
            ->labels(['Sector 1', 'Sector 2', 'Secteur 3'])
            ->dataset('Jendouba', [random_int(500, 7800), random_int(1250, 7000), random_int(2000, 5000)]);
    }
}
