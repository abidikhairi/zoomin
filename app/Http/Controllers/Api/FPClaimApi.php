<?php

namespace App\Http\Controllers\Api;

use App\Models\Citizen\Claim;
use App\Models\Citizen\ClaimType;
use App\Models\RoomPresident;
use Illuminate\Http\JsonResponse;

class FPClaimApi
{

    public const CLAIMS_PER_PAGE = 5;

    /**
     * @return JsonResponse
     */
    public function claims()
    {
        $claims = Claim::query()
            ->join('establishments', 'establishments.id', '=', 'claims.establishment_id')
            ->join('governorates', 'governorates.id', '=', 'establishments.governorate_id')
            ->join('claim_types', 'claim_types.id', '=', 'claims.claim_type_id')
            //->whereNull('claims.status')
            ->select(['claims.status', 'claims.id', 'establishment_id', 'citizen_id', 'claims.sector_id', 'claims.governorate_id', 'claims.claim_type_id', 'claims.magistrate_id'])
            ->with(['establishment', 'sector', 'citizen', 'magistrate', 'claimType', 'citizen.profile', 'citizen.user', 'governorate', 'governorate.room'])
            ->paginate(self::CLAIMS_PER_PAGE);

        $claimTypes = ClaimType::all();

        return response()->json(compact('claims', 'claimTypes'));
    }

    public function claimsOrderedByCitizenProfilePriority()
    {
        $claims = Claim::query()
            ->join('establishments', 'establishments.id', '=', 'claims.establishment_id')
            ->join('governorates', 'governorates.id', '=', 'establishments.governorate_id')
            ->join('citizens', 'citizens.id', '=', 'claims.citizen_id')
            ->join('profiles', 'profiles.id', '=', 'citizens.profile_id')
            ->select(['profiles.priority', 'claims.status', 'claims.id', 'establishment_id', 'citizen_id', 'claims.sector_id', 'claims.governorate_id', 'claims.claim_type_id', 'claims.magistrate_id'])
            ->with(['establishment', 'sector', 'citizen', 'magistrate', 'claimType', 'citizen.profile', 'citizen.user', 'governorate', 'governorate.room'])
            ->orderByDesc('profiles.priority')
            ->whereNull('claims.status')
            ->paginate(self::CLAIMS_PER_PAGE);

        return response()->json(compact('claims'));
    }

    public function claimsOrderedByEstablishments()
    {
        $claims = Claim::query()
            ->join('establishments', 'establishments.id', '=', 'claims.establishment_id')
            ->join('governorates', 'governorates.id', '=', 'establishments.governorate_id')
            ->select(['claims.status', 'claims.id', 'establishment_id', 'citizen_id', 'claims.sector_id', 'claims.governorate_id', 'claims.claim_type_id', 'claims.magistrate_id'])
            ->with(['establishment', 'sector', 'citizen', 'magistrate', 'claimType', 'citizen.profile', 'citizen.user', 'governorate', 'governorate.room'])
            ->whereNull('claims.status')
            ->get()
            ->groupBy('establishment_id')
            ->flatten()
            ->paginate(self::CLAIMS_PER_PAGE);

        return response()->json(compact('claims'));
    }

    public function claimsOrderedBySectors()
    {
        $claims = Claim::query()
            ->join('establishments', 'establishments.id', '=', 'claims.establishment_id')
            ->join('governorates', 'governorates.id', '=', 'establishments.governorate_id')
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
