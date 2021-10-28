<?php

namespace App\Models\CourtOfAudit;

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
        'has_establishment'
    ];

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
