<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CourtOfAudit\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function observations(Report $report) {
        $observations = $report->observations()->paginate(5);
        return view('observations', compact('observations', 'report'));
    }
}
