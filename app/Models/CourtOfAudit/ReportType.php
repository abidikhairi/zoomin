<?php

namespace App\Models\CourtOfAudit;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportType extends Model
{
    use HasFactory;

    protected $fillable = ['type'];

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
