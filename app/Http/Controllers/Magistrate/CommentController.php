<?php

namespace App\Http\Controllers\Magistrate;

use App\Models\CourtOfAudit\Report;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function show(Report $report) {
        $comments = $report->comments()->orderBy('created_at', 'ASC');
        return view('magistrate.report.comment.show', compact('report', 'comments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string'
        ]);

        dd($request);
    }
}
