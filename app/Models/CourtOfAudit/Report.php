<?php

namespace App\Models\CourtOfAudit;

use App\Models\Administration\Establishment;
use App\Models\Administration\Sector;
use App\Models\Magistrate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'year',
        'link',
        'pdf_file',
        'visible'
    ];

    public function observations()
    {
        return $this->hasMany(Observation::class);
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

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function ReportType()
    {
        return $this->belongsTo(ReportType::class);
    }
}
