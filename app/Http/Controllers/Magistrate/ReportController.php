<?php


namespace App\Http\Controllers\Magistrate;


use App\Models\Administration\Establishment;
use App\Models\Administration\Room;
use App\Models\Administration\Sector;
use App\Models\CourtOfAudit\Observation;
use App\Models\CourtOfAudit\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public const REPORTS_PER_PAGE = 10;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $reports = $this->magistrate()->reports()->paginate(self::REPORTS_PER_PAGE);

        return view('magistrate.report.index', compact('reports'));
    }

    public function create()
    {
        $sectors = Sector::all();
        return view('magistrate.report.create', compact('sectors'));
    }

    public function showObservationsForm(Report $report, int $observations)
    {
        return view('magistrate.report.observations-form', compact('observations', 'report'));
    }

    public function step1(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'year' => 'required|numeric',
            'type' => 'required|string',
            'pdf_file' => 'required|file',
            'sector' => 'required',
            'establishment' => 'required',
            'observations' => 'required|numeric'
        ]);

        $sector = Sector::find($request->sector);
        $establishment = Establishment::find($request->establishment);
        $magistrate = $this->magistrate();

        $pdfFileName = uniqid().'-'.$request->file('pdf_file')->getClientOriginalName();
        $request->file('pdf_file')->storeAs('public/reports/', $pdfFileName);

        $report = new Report([
            'title' => $request->title,
            'link' => $request->link,
            'year' => $request->year,
            'type' => $request->type,
            'pdf_file' => $pdfFileName
        ]);

        $report->sector()->associate($sector);
        $report->establishment()->associate($establishment);
        $report->magistrate()->associate($magistrate);
        $report->save();

        return redirect()->route('report.observations.create', [
            'report' => $report->id,
            'observations' => $request->observations
        ]);
    }

    public function step2(Request $request)
    {
        $this->validate($request, [
            'financial_impact' => 'required',
            'content' => 'required',
            'fault' => 'required',
            'report' => 'required'
        ]);
        $data = $request->all();

        $report = Report::find($request->report);

        $observation = new Observation([
            'financial_impact' => $data['financial_impact'],
            'fault' => $data['fault'],
            'observation' => $data['content'],
        ]);

        $observation->report()->associate($report);
        $observation->save();

        return [
            'message' => __('observation.stored.success')
        ];
    }

    public function room()
    {
        $magistrate = $this->magistrate();
        $roomId = $magistrate->room->id;
        $reports = Report::query()
            ->join('sectors', 'sectors.id', '=', 'reports.sector_id')
            ->join('establishments', 'establishments.id', '=', 'reports.establishment_id')
            ->join('magistrates', 'magistrates.id', '=', 'reports.magistrate_id')
            ->join('rooms', 'rooms.id', '=', 'magistrates.room_id')
            ->where('magistrates.room_id', '=', $roomId)
            ->select(['reports.id', 'reports.sector_id', 'reports.establishment_id', 'reports.magistrate_id', 'reports.type'])
            ->get();

        return view('magistrate.report.room.index', compact('reports'));
    }
}
