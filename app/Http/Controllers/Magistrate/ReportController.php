<?php


namespace App\Http\Controllers\Magistrate;


use App\Models\Administration\Establishment;
use App\Models\Administration\Room;
use App\Models\Administration\Sector;
use App\Models\CourtOfAudit\Observation;
use App\Models\CourtOfAudit\Report;
use App\Models\CourtOfAudit\ReportType;
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

        $teams = auth()->user()->teams;
        $types = collect();

        foreach ($teams as $team) {
            foreach ($team->reportTypes as $type) {
                $types->push($type);
            }
        }

        return view('magistrate.report.create', compact('sectors', 'types'));
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
            'year' => 'required|digits:4|integer|min:2000|max:'.(date('Y')),
            'type' => 'required|exists:report_types,id',
            'sector' => 'exists:sectors,id',
            'establishment' => 'exists:establishments,id',
            'pdf_file' => 'required|file',
        ]);

        $sector = Sector::find($request->sector);
        $establishment = Establishment::find($request->establishment);
        $type = ReportType::find($request->type);
        $magistrate = $this->magistrate();

        $pdfFileName = uniqid().'-'.$request->file('pdf_file')->getClientOriginalName();
        $request->file('pdf_file')->storeAs('public/reports/', $pdfFileName);

        $report = new Report([
            'title' => $request->title,
            'link' => $request->link,
            'year' => $request->year,
            'pdf_file' => $pdfFileName
        ]);

        $report->reportType()->associate($type);
        $report->sector()->associate($sector);
        $report->establishment()->associate($establishment);
        $report->magistrate()->associate($magistrate);
        $report->save();

        if (!$type->has_observations) {
            return redirect('/magistrate');
        }

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
            'title' => 'required',
            'report' => 'required',
            'impact' => 'numeric'
        ]);
        $data = $request->all();

        $report = Report::find($request->report);

        $observation = new Observation([
            'financial_impact' => $data['financial_impact'],
            'title' => $data['title'],
            'observation' => $data['content'],
            'impact' => $data['impact']
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
            ->join('report_types', 'report_types.id', '=', 'reports.report_type_id')
            ->join('rooms', 'rooms.id', '=', 'magistrates.room_id')
            ->where('magistrates.room_id', '=', $roomId)
            ->select(['reports.id', 'reports.sector_id', 'reports.establishment_id', 'reports.magistrate_id', 'reports.visible', 'report_types.type'])
            ->get();

        return view('magistrate.report.room.index', compact('reports'));
    }
}
