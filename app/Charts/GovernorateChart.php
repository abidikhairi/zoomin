<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

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
        return Chartisan::build()
            ->labels(['First', 'Second', 'Third'])
            ->dataset('Claims', [random_int(1, 25), random_int(1, 25), random_int(1, 25)]);
    }
}
