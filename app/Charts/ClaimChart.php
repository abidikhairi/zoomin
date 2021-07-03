<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class ClaimChart extends BaseChart
{

    public ?string $name = 'claim_chart';
    public ?string $routeName = 'claim_chart';

    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     * @param Request $request
     * @return Chartisan
     */
    public function handler(Request $request): Chartisan
    {
        if ($request->get('group'))
        {
            return $this->groupBy($request->get('group'));
        }
        return $this->groupByGovernorate();
    }

    /**
     * @return Chartisan
     */
    public function groupByGovernorate(): Chartisan
    {
        return Chartisan::build()
            ->labels(['Jendouba', 'Beja', 'Tunis'])
            ->dataset('Claims Accepted', [5, 7, 3])
            ->dataset('Claims Rejected', [8, 10, 9]);
    }

    /**
     * @param int $top
     * @return Chartisan
     */
    public function groupBy($key, $top = 5): Chartisan
    {
        return Chartisan::build()
            ->labels(['Secteur 1', 'Secteur 2', 'Secteur 3', 'Secteur 4', 'Secteur 5'])
            ->dataset('Claims Accepted', [5, 17, 3, 23, 14])
            ->dataset('Claims Rejected', [8, 9, 10, 11, 7]);
    }
}
