<?php

namespace App\Models\Administration;

use App\Models\Citizen\Claim;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    use HasFactory, CrudTrait;

    protected $fillable = ['name'];

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
}
