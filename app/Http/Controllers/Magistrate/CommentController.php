<?php

namespace App\Http\Controllers\Magistrate;

use App\Models\CourtOfAudit\Comment;
use App\Models\CourtOfAudit\Report;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function show(Report $report) {
        $comments = $report->comments()->orderBy('created_at', 'ASC')->get();
        return view('magistrate.report.comment.show', compact('report', 'comments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'report' => 'required|exists:reports,id'
        ]);
        $data = $request->all();

        $magistrate = $this->magistrate();
        $report = Report::find($data['report']);

        $comment = new Comment([
            'content' => $data['content']
        ]);

        $comment->magistrate()->associate($magistrate);
        $comment->report()->associate($report);
        $comment->save();

        return redirect()->route('report.comment.show', ['report' => $report->id]);
    }
}
