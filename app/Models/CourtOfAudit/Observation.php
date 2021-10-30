<?php

namespace App\Models\CourtOfAudit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observation extends Model
{
    use HasFactory;


    protected $fillable = [
        'observation',
        'title',
        'financial_impact',
        'impact'
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
