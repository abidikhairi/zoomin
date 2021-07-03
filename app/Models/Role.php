<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    use CrudTrait;

    public $guarded = [];
}
