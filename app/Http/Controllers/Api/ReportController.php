<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Administration\Establishment;
use App\Models\Administration\Governorate;
use App\Models\CourtOfAudit\Report;

class ReportController extends Controller
{

    /**
     * @param Governorate $governorate
     * @param Establishment $establishment
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function reportByGovernorateEstablishment(Governorate $governorate, Establishment $establishment)
    {
        return $governorate->establishments()->where('establishments.id', '=', $establishment->id)
            ->join('reports', 'reports.establishment_id', '=', 'establishments.id')
            ->join('report_types', 'report_types.id', '=', 'reports.report_type_id')
            ->get()
            ->filter(fn ($obj) => $obj->is_public === true );
    }

    public function index() {
        return Report::with('sector', 'establishment')->where('visible', '=' , true)->get();
    }

}
