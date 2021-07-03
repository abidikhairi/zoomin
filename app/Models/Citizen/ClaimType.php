<?php

namespace App\Models\Citizen;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaimType extends Model
{
    use HasFactory, CrudTrait;

    protected $fillable = [
        'name'
    ];

    public function claims()
    {
        return $this->hasMany(Claim::class);
    }
}
