<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class FaultChart extends BaseChart
{
    public ?string $name = 'fault_chart';
    public ?string $routeName = 'fault_chart';

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
            ->labels(['Sector 1', 'Sector 4', 'Sector 3'])
            ->dataset('Fault 1', [10, 25, 40])
            ->dataset('Fault 2', [3, 2, 1])
            ->dataset('Fault 3', [3, 2, 1]);
    }
}
