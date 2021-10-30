<?php

namespace App\Http\Controllers\RoomPresident;

use App\Models\CourtOfAudit\Report;

class ReportController extends Controller
{
    public function show(Report $report)
    {
        $comments = $report->comments()->orderBy('created_at', 'ASC')->get();
        return view('magistrate.report.comment.show', compact('report', 'comments'));
    }

    public function index()
    {
        $president = $this->roomPresident();
        $roomId = $president->room->id;

        $reports = Report::query()
            ->join('sectors', 'sectors.id', '=', 'reports.sector_id')
            ->join('establishments', 'establishments.id', '=', 'reports.establishment_id')
            ->join('magistrates', 'magistrates.id', '=', 'reports.magistrate_id')
            ->join('rooms', 'rooms.id', '=', 'magistrates.room_id')
            ->where('magistrates.room_id', '=', $roomId)
            ->select(['reports.id', 'reports.sector_id', 'reports.establishment_id', 'reports.magistrate_id', 'reports.type', 'reports.visible'])
            ->get();

        return view('magistrate.report.room.index', compact('reports'));
    }

    public function publish(Report $report)
    {
        $report->update([
            'visible' => true
        ]);

        return redirect()->route('room-president.report.index');
    }
}
