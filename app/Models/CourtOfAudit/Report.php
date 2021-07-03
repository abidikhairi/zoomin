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

    // TODO: translate this
    public const TYPE_1 = 'type 1';
    public const TYPE_2 = 'type 2';
    public const TYPE_3 = 'type 3';

    public const TYPES = [
        self::TYPE_1,
        self::TYPE_2,
        self::TYPE_3
    ];

    protected $fillable = [
        'title',
        'year',
        'link',
        'type',
        'pdf_file'
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
}
