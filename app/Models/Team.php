<?php

namespace App\Models;

use App\Models\CourtOfAudit\ReportType;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Laratrust\Models\LaratrustTeam;

class Team extends LaratrustTeam
{
    use CrudTrait;

    public $guarded = [];

    protected $identifiableAttribute = 'name';

    public function reportTypes()
    {
        return $this->belongsToMany(ReportType::class)->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
