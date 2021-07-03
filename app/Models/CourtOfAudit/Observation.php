<?php

namespace App\Models\CourtOfAudit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observation extends Model
{
    use HasFactory;

    // TODO: translate this
    public const FAULT_1 = 'fault 1';
    public const FAULT_2 = 'fault 2';
    public const FAULT_3 = 'fault 3';

    public const FAULTS = [
        self::FAULT_1,
        self::FAULT_2,
        self::FAULT_3,
    ];

    protected $fillable = [
        'observation',
        'fault',
        'financial_impact'
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
