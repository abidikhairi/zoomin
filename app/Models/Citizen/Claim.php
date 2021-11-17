<?php

namespace App\Models\Citizen;

use App\Models\Administration\Establishment;
use App\Models\Administration\Governorate;
use App\Models\Administration\Sector;
use App\Models\Citizen;
use App\Models\Magistrate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    use HasFactory;

    public const STATUS_ACCEPTED = 'accepted';
    public const STATUS_REJECTED = 'rejected';

    public const STATUS = [
        self::STATUS_ACCEPTED,
        self::STATUS_REJECTED
    ];

    public static function statusAr() {
        return [
            __('charts.claim.accepted'),
            __('charts.claim.rejected'),
        ];
    }

    protected $fillable = [
        'subject',
        'files',
        'assigned',
        'status'
    ];

    protected $casts = [
        'files' => 'array'
    ];

    public function citizen()
    {
        return $this->belongsTo(Citizen::class);
    }

    public function magistrate()
    {
        return $this->belongsTo(Magistrate::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function establishment()
    {
        return $this->belongsTo(Establishment::class);
    }

    public function response()
    {
        return $this->hasOne(Response::class);
    }

    public function claimType()
    {
        return $this->belongsTo(ClaimType::class);
    }

    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }
}
