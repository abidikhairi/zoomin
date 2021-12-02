<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;

class ObservationController
{

    public static function getObservationsForMunicipalities($municipalities)
    {
        $result = [];
        foreach ($municipalities as $municipality) {
            $result[] = DB::table('establishments')
                ->join('governorates', 'governorates.id', '=', 'establishments.governorate_id')
                ->join('reports', 'reports.establishment_id', '=', 'establishments.id')
                ->join('observations', 'observations.report_id', '=', 'reports.id')
                ->where('establishments.id', '=', $municipality->id)
                ->groupBy('establishments.name', 'governorates.name')
                ->select(DB::raw('count(observations.id) as observations'))
                ->addSelect('establishments.name', DB::raw('governorates.name as governorate'))
                ->first();
        }
        return $result;
    }

    public function rankMunicipalities() {
        $municipalities = DB::table('establishments')->select('name', 'id')
            ->where('is_municipality', '=', true)
            ->get();
        $result = ObservationController::getObservationsForMunicipalities($municipalities);

        return response()->json([
            'observations' => collect($result)->whereNotNull()->sortByDesc('observations')->take(10)->toArray()
        ]);
    }

}
