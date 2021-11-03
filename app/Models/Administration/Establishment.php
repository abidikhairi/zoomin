<?php

namespace App\Models\Administration;

use App\Models\Citizen\Claim;
use App\Models\CourtOfAudit\Report;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    use HasFactory, CrudTrait;

    protected $fillable = ['name', 'is_municipality'];

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }

    public function claims()
    {
        return $this->hasMany(Claim::class);
    }

    public function reports() {
        return $this->hasMany(Report::class);
    }
}
