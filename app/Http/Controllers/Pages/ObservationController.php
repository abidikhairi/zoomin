<?php

namespace App\Http\Controllers\Pages;

use App\Models\Administration\Governorate;
use Illuminate\Support\Facades\DB;

class ObservationController
{
    public function index(Governorate $governorate)
    {

        $observations = DB::table('observations')
            ->join('reports', 'reports.id', '=', 'observations.report_id')
            ->join('establishments', 'establishments.id', '=', 'reports.establishment_id')
            ->join('governorates', 'governorates.id', '=', 'establishments.governorate_id')
            ->where('governorates.id', '=', $governorate->id)
            ->select('reports.title', 'establishments.name', 'observations.observation', 'observations.financial_impact')
            ->get();
        return view('pages.observations', compact('observations', 'governorate'));
    }
}
