<?php


namespace App\Http\Controllers\Magistrate;


use App\Models\Citizen\Claim;
use App\Models\Citizen\Response;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Claim $claim)
    {
        return view('magistrate.claim.show', compact('claim'));
    }

    public function index()
    {
        $claims = $this->magistrate()->claims;

        return view('magistrate.claim.index', compact('claims'));
    }

    public function showRespondForm(Claim $claim)
    {
        return view('magistrate.claim.respond', compact('claim'));
    }

    public function respond(Request $request)
    {
        $this->validate($request, [
            'claim' => 'required',
            'report_file' => 'required|file',
        ]);

        $claim = Claim::find($request->claim);
        $magistrate = $this->magistrate();

        $filename = uniqid().'-'. $request->file('report_file')->getClientOriginalName();
        $request->file('report_file')->storeAs('/public/responses/', $filename);

        $response = new Response([
            'report_file' => '/public/responses/'. $filename
        ]);

        $response->magistrate()->associate($magistrate);
        $response->claim()->associate($claim);
        $response->save();

        return redirect(auth()->user()->account);
    }
}
