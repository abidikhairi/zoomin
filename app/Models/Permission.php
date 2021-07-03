<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
{
    use CrudTrait;

    public $guarded = [];
}
