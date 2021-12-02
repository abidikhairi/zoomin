<?php

namespace App\Http\Controllers\FirstPresident;

use App\Models\Citizen\Claim;
use App\Models\Citizen\Response;
use App\Models\Magistrate;
use App\Notifications\Claim\ClaimAssigned;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class ClaimController extends Controller
{
    public const ARCHIVED_CLAIMS_PER_PAGE = 10;

    public function index()
    {
        return view('first-president.claim.index');
    }

    public function archive()
    {

        $archivedClaims = Claim::query()
            ->selectRaw(DB::raw('claims.id as claim_id'))
            ->addSelect('assigned')
            ->addSelect('citizen_id')
            ->addSelect('claims.magistrate_id')
            ->addSelect('claims.sector_id')
            ->addSelect('claims.establishment_id')
            ->addSelect(DB::raw('responses.id as response_id'))
            ->join('establishments', 'establishments.id', '=', 'claims.establishment_id')
            ->leftJoin('responses', 'responses.claim_id', '=', 'claims.id')
            ->join('governorates', 'governorates.id', '=', 'establishments.governorate_id')
            ->where('assigned', '=', true)
            ->get()
            ->each(function ($claim) { $claim->response = Response::find($claim->response_id); });

        $waitingList = $archivedClaims->filter(function ($claim) { return $claim->response === null; });
        $respondedClaims = $archivedClaims->filter(function ($claim) { return $claim->response !== null; });

        return view('first-president.claim.archive', compact('waitingList', 'respondedClaims'));
    }

    public function assign(Request $request)
    {
        $this->validate($request, [
            'magistrate' => 'required',
            'claim' => 'required'
        ]);

        $magistrate = Magistrate::query()->where('id', '=', $request->magistrate)->firstOrFail();
        $claim = Claim::query()->where('id', '=', $request->claim)->firstOrFail();

        $claim->magistrate()->associate($magistrate);
        $claim->save();
        $claim->update([
            'status' => Claim::STATUS_ACCEPTED,
            'assigned' => true
        ]);

        Notification::send($magistrate->user, new ClaimAssigned($claim));

        return back();
    }
}
