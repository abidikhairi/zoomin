<?php

namespace App\Http\Controllers\Api;

use App\Models\CourtOfAudit\ReportType;

class ReportTypeController
{

    /**
     * @param ReportType $reportType
     * @return ReportType
     */
    public function show(ReportType $reportType) {
        return $reportType;
    }

}
