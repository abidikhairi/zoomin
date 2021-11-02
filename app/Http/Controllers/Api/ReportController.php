<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Administration\Establishment;
use App\Models\Administration\Governorate;
use App\Models\Administration\Sector;
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
        return Report::with('observations', 'reportType', 'establishment')
            ->where('establishment_id', '=', $establishment->id)
            ->where('visible', '=', true)
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
            ->whereHas('reports', function ($query) {
                return $query->where('visible', '=', true);
            })
            ->get();

        foreach ($result as $establishment) {
            foreach ($establishment->reports as $report) {
                $data[] = sprintf('%s: %s', $establishment->name, $report->title);
            }
        }

        return $data;
    }

    public function reportByGovernorateAndSector(Sector $sector, Governorate $governorate) {
        return Report::with('sector', 'establishment', 'reportType')
            ->whereHas('sector', function ($query) use($sector) {
                return $query->where('id', '=', $sector->id);
            })
            ->whereHas('establishment', function ($query) use ($governorate) {
                return $query->where('governorate_id', '=', $governorate->id);
            })
            ->where('visible', '=' , true)
            ->whereHas('reportType', function($query) {
                return $query->where('is_public', '=', true);
            })
            ->get();

    }

    public function reportBySector(Sector $sector) {
        return Report::with('sector', 'establishment', 'reportType')
            ->whereHas('sector', function ($query) use($sector) {
                return $query->where('id', '=', $sector->id);
            })
            ->where('visible', '=' , true)
            ->whereHas('reportType', function($query) {
                return $query->where('is_public', '=', true);
            })
            ->get();
    }

    public function index() {
        return Report::with('sector', 'establishment', 'reportType')
            ->where('visible', '=' , true)
            ->whereHas('reportType', function($query) {
                return $query->where('is_public', '=', true);
            })
            ->get();
    }

}
