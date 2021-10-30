<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Administration\Establishment;
use App\Models\Administration\Governorate;
use App\Models\CourtOfAudit\Report;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{

    /**
     * @param Governorate $governorate
     * @param Establishment $establishment
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function reportByGovernorateEstablishment(Governorate $governorate, Establishment $establishment)
    {
        return Report::with('observations', 'reportType', 'establishment')
            ->where('establishment_id', '=', $establishment->id)
            ->get()
            ->filter(fn ($obj) => $obj->reportType->is_public === true);
    }

    public function reportByGovernorate(Governorate $governorate)
    {
        $data = [];
        $result = $governorate->establishments()
            ->with(['reports', 'reports.reportType'])
            ->whereHas('reports.reportType', function ($query) {
                return $query->where('is_public', '=', true);
            })
            ->get();

        foreach ($result as $establishment) {
            foreach ($establishment->reports as $report) {
                $data[] = sprintf('%s: %s', $establishment->name, $report->title);
            }
        }

        return $data;
    }

    public function index() {
        return Report::with('sector', 'establishment')->where('visible', '=' , true)->get();
    }

}
