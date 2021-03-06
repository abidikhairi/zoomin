<?php

namespace App\Models\CourtOfAudit;

use App\Models\Team;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportType extends Model
{
    use HasFactory;
    use CrudTrait;

    protected $fillable = [
        'type',
        'has_observations',
        'has_sector',
        'has_establishment',
        'is_public'
    ];

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class)->withTimestamps();
    }

}
