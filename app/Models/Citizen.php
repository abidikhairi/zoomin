<?php

namespace App\Models;

use App\Models\Citizen\Claim;
use App\Models\Citizen\Profile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citizen extends Model
{
    use HasFactory;

    protected $fillable = [
        'telephone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function claims()
    {
        return $this->hasMany(Claim::class);
    }

    public function profile() {
        return $this->belongsTo(Profile::class);
    }
}
