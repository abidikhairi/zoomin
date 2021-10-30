<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\CourtOfAudit\Report;

class ReportController extends Controller
{

    public function index() {
        return Report::with('sector', 'establishment')->where('visible', '=' , true)->get();
    }

}
