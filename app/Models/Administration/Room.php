<?php

namespace App\Models\Administration;

use App\Models\GovernmentCommissioner;
use App\Models\Magistrate;
use App\Models\RoomPresident;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory, CrudTrait;

    protected $fillable = ['name'];

    public function governorate()
    {
        return $this->hasOne(Governorate::class);
    }

    public function magistrates()
    {
        return $this->hasMany(Magistrate::class);
    }

    public function roomPresident()
    {
        return $this->belongsTo(RoomPresident::class);
    }

    public function governmentCommissioner()
    {
        return $this->belongsTo(GovernmentCommissioner::class);
    }

}
