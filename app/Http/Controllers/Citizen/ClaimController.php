<?php


namespace App\Http\Controllers\Citizen;


use App\Models\Administration\Establishment;
use App\Models\Administration\Sector;
use App\Models\Citizen\Claim;
use App\Models\Citizen\ClaimType;
use App\Notifications\Claim\ClaimCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ClaimController extends Controller
{
    public function create()
    {
        $sectors = Sector::all();
        $types = ClaimType::all();
        return view('citizen.claim.create', compact('sectors', 'types'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'establishment' => 'required',
            'sector' => 'required',
            'subject' => 'required',
            'files' => 'required',
            'claim_type' => 'required'
        ]);
        $user = auth()->user();
        $sector = Sector::find($request->sector);
        $establishment = Establishment::find($request->establishment);
        $type = ClaimType::find($request->claim_type);

        $files = [];
        foreach ($request->file('files') as $index => $file){
            $idx = uniqid();
            $prefix = "/public/claims/{$user->id}/";
            $filename = "$idx-".$file->getClientOriginalName();
            $files['file_'.$index] = $prefix. $filename;
            $file->storeAs($prefix, $filename);
        }
        $claim = new Claim([
            'subject' => $request->subject,
            'files' => $files
        ]);

        $claim->claimType()->associate($type);
        $claim->citizen()->associate($user->citizen);
        $claim->sector()->associate($sector);
        $claim->establishment()->associate($establishment);
        $claim->governorate()->associate($establishment->governorate);
        $claim->save();

        Notification::send($establishment->governorate->room->roomPresident->user, new ClaimCreated($claim));

        return redirect()->to($user->account);
    }
}
