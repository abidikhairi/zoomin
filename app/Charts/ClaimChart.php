<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Administration\Governorate;
use App\Models\Administration\Room;
use App\Models\Citizen\Claim;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        if ($request->get('room') == -1) {
            $labels = [];

            $dbStatus = Claim::STATUS;
            $statusCount = count(Claim::STATUS);
            $statusAr = Claim::statusAr();

            foreach (Governorate::all() as $governorate) {
                $labels[] = $governorate->name;
            }

            $chartisan = Chartisan::build()
                ->labels($labels);

            for ($i = 0; $i < $statusCount; $i++) {
                $data = [];
                foreach ($labels as $label) {
                    $data[] = DB::table('claims')
                        ->join('establishments', 'establishments.id', '=', 'claims.establishment_id')
                        ->join('governorates', 'governorates.id', '=', 'establishments.governorate_id')
                        ->where([
                            ['governorates.name', '=', $label],
                            ['claims.status', '=', $dbStatus[$i]]
                        ])
                        ->count();
                }
                $chartisan->dataset($statusAr[$i], $data);
            }
            return $chartisan;
        }

        $room = Room::query()->where('id', '=', $request->get('room'))->firstOrFail();
        $labels = [];

        $dbStatus = Claim::STATUS;
        $statusCount = count(Claim::STATUS);
        $statusAr = Claim::statusAr();

        foreach ($room->governorates as $governorate) {
            $labels[] = $governorate->name;
        }

        $chartisan = Chartisan::build()
            ->labels($labels);

        for ($i = 0; $i < $statusCount; $i++) {
            $data = [];
            foreach ($labels as $label) {
                $data[] = DB::table('claims')
                    ->join('establishments', 'establishments.id', '=', 'claims.establishment_id')
                    ->join('governorates', 'governorates.id', '=', 'establishments.governorate_id')
                    ->where([
                        ['governorates.name', '=', $label],
                        ['claims.status', '=', $dbStatus[$i]]
                    ])
                    ->count();
            }
            $chartisan->dataset($statusAr[$i], $data);
        }
        return $chartisan;
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
