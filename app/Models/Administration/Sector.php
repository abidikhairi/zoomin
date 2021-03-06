<?php

namespace App\Models\Administration;

use App\Models\Citizen\Claim;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory, CrudTrait;

    protected $fillable = ['name'];

    public function establishments()
    {
        return $this->hasMany(Establishment::class);
    }

    public function claims()
    {
        return $this->hasMany(Claim::class);
    }
}
