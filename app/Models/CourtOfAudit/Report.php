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


    public const TYPE_DIAGNOSTIC = 'Rapport de Diagnostic';
    public const TYPE_PRELIMINAIRE = 'Rapport Préliminaire';
    public const TYPE_SYNTHESE = 'Rapport de Synthése';
    public const TYPE_ANNUEL = 'Rapport Annuel';
    public const TYPE_SPECIFIQUE = 'Rapport Spécifiques';

    public const TYPES = [
        self::TYPE_DIAGNOSTIC,
        self::TYPE_PRELIMINAIRE,
        self::TYPE_SYNTHESE,
        self::TYPE_ANNUEL,
        self::TYPE_SPECIFIQUE
    ];

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

    public function type()
    {
        return $this->belongsTo(ReportType::class);
    }
}
