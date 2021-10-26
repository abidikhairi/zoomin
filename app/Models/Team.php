<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Laratrust\Models\LaratrustTeam;

class Team extends LaratrustTeam
{
    use CrudTrait;

    public $guarded = [];

    protected $identifiableAttribute = 'name';

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
