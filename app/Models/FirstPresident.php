<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirstPresident extends Model
{
    use HasFactory, CrudTrait;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
