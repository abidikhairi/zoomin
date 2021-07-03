<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Citizen\Claim;
use App\Models\Citizen\ClaimType;
use App\Models\Magistrate;
use App\Models\RoomPresident;
use App\Notifications\Claim\ClaimAssigned;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use function GuzzleHttp\Psr7\str;

class RoomPresidentController extends Controller
{

    public const CLAIMS_PER_PAGE = 5;

    public function archiveClaim(Request $request)
    {
        $this->validate($request, [
            'claim_id' => ['required', 'exists:claims,id']
        ]);

        $claim = Claim::find($request->claim_id);

        $claim->magistrate()->disassociate();

        $claim->update([
            'status' => Claim::STATUS_REJECTED
        ]);

        return response()->json([
            'message' => __('message.claim.archived.success')
        ]);
    }

    public function assignClaimToMagistrate(Request $request)
    {
        $this->validate($request, [
            'claim_id' => ['required', 'exists:claims,id'],
            'magistrate_id' => ['required', 'exists:magistrates,id']
        ]);

        $claim = Claim::find($request->claim_id);
        $magistrate = Magistrate::find($request->magistrate_id);
        $magistrate->claims()->save($claim);

        $claim->update([
            'status' => Claim::STATUS_ACCEPTED,
            'assigned' => true
        ]);

        Notification::send($magistrate->user, new ClaimAssigned($claim));

        return response()->json([
            'message' => __('message.claim.assigned.success')
        ]);
    }

    /**
     * @param RoomPresident $roomPresident
     * @return JsonResponse
     */
    public function claims(RoomPresident $roomPresident)
    {
        $governorates = $roomPresident->room->governorates->map(function($g) { return $g->id;})->toArray();
        $claims = Claim::query()
            ->join('establishments', 'establishments.id', '=', 'claims.establishment_id')
            ->join('governorates', 'governorates.id', '=', 'establishments.governorate_id')
            ->join('claim_types', 'claim_types.id', '=', 'claims.claim_type_id')
            ->whereIn('governorates.id', $governorates)
            ->whereNull('claims.status')
            ->select(['claims.status', 'claims.id', 'establishment_id', 'citizen_id', 'claims.sector_id', 'claims.governorate_id', 'claims.claim_type_id', 'claims.magistrate_id'])
            ->with(['establishment', 'sector', 'citizen', 'magistrate', 'claimType', 'citizen.profile', 'citizen.user', 'governorate', 'governorate.room'])
            ->paginate(self::CLAIMS_PER_PAGE);

        $claimTypes = ClaimType::all();

        return response()->json(compact('claims', 'roomPresident', 'claimTypes'));
    }

    public function claimsForType(Request $request, RoomPresident $roomPresident)
    {
        $type = $request->query('type', '');
        if ($type === '') {
            return $this->claims($roomPresident);
        }
        $governorates = $roomPresident->room->governorates->map(function($g) { return $g->id;})->toArray();

        $claims = Claim::query()
            ->join('establishments', 'establishments.id', '=', 'claims.establishment_id')
            ->join('governorates', 'governorates.id', '=', 'establishments.governorate_id')
            ->join('claim_types', 'claim_types.id', '=', 'claims.claim_type_id')
            ->whereIn('governorates.id', $governorates)
            ->select(['claims.status', 'claims.id', 'establishment_id', 'citizen_id', 'claims.sector_id', 'claims.governorate_id', 'claims.claim_type_id', 'claims.magistrate_id'])
            ->with(['establishment', 'sector', 'citizen', 'magistrate', 'claimType', 'citizen.profile', 'citizen.user', 'governorate', 'governorate.room'])
            ->where('claim_types.name', '=', $type)
            ->whereNull('claims.status')
            ->paginate(self::CLAIMS_PER_PAGE);

        return response()->json(compact('claims'));

    }

    public function claimsOrderedByCitizenProfilePriority(RoomPresident $roomPresident) {
        $governorates = $roomPresident->room->governorates->map(function($g) { return $g->id;})->toArray();

        $claims = Claim::query()
            ->join('establishments', 'establishments.id', '=', 'claims.establishment_id')
            ->join('governorates', 'governorates.id', '=', 'establishments.governorate_id')
            ->join('citizens', 'citizens.id', '=', 'claims.citizen_id')
            ->join('profiles', 'profiles.id', '=', 'citizens.profile_id')
            ->whereIn('governorates.id', $governorates)
            ->select(['profiles.priority', 'claims.status', 'claims.id', 'establishment_id', 'citizen_id', 'claims.sector_id', 'claims.governorate_id', 'claims.claim_type_id', 'claims.magistrate_id'])
            ->with(['establishment', 'sector', 'citizen', 'magistrate', 'claimType', 'citizen.profile', 'citizen.user', 'governorate', 'governorate.room'])
            ->orderByDesc('profiles.priority')
            ->whereNull('claims.status')
            ->paginate(self::CLAIMS_PER_PAGE);

        return response()->json(compact('claims'));
    }

    public function claimsOrderedByEstablishments(RoomPresident $roomPresident)
    {
        $governorates = $roomPresident->room->governorates->map(function($g) { return $g->id;})->toArray();

        $claims = Claim::query()
            ->join('establishments', 'establishments.id', '=', 'claims.establishment_id')
            ->join('governorates', 'governorates.id', '=', 'establishments.governorate_id')
            ->whereIn('governorates.id', $governorates)
            ->select(['claims.status', 'claims.id', 'establishment_id', 'citizen_id', 'claims.sector_id', 'claims.governorate_id', 'claims.claim_type_id', 'claims.magistrate_id'])
            ->with(['establishment', 'sector', 'citizen', 'magistrate', 'claimType', 'citizen.profile', 'citizen.user', 'governorate', 'governorate.room'])
            ->whereNull('claims.status')
            ->get()
            ->groupBy('establishment_id')
            ->flatten()
            ->paginate(self::CLAIMS_PER_PAGE);

        return response()->json(compact('claims'));
    }

    public function claimsOrderedBySectors(RoomPresident $roomPresident)
    {
        $governorates = $roomPresident->room->governorates->map(function($g) { return $g->id;})->toArray();

        $claims = Claim::query()
            ->join('establishments', 'establishments.id', '=', 'claims.establishment_id')
            ->join('governorates', 'governorates.id', '=', 'establishments.governorate_id')
            ->whereIn('governorates.id', $governorates)
            ->select(['claims.status', 'claims.id', 'establishment_id', 'citizen_id', 'claims.sector_id', 'claims.governorate_id', 'claims.claim_type_id', 'claims.magistrate_id'])
            ->with(['establishment', 'sector', 'citizen', 'magistrate', 'claimType', 'citizen.profile', 'citizen.user', 'governorate', 'governorate.room'])
            ->whereNull('claims.status')
            ->get()
            ->groupBy('sector_id')
            ->flatten()
            ->paginate(self::CLAIMS_PER_PAGE);

        return response()->json(compact('claims'));
    }
}
