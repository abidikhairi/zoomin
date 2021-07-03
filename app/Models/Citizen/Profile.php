<?php

namespace App\Models\Citizen;

use App\Models\Citizen;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory, CrudTrait;

    protected $fillable = [
        'name',
        'priority',
    ];

    public function citizens()
    {
        return $this->hasMany(Citizen::class);
    }
}
