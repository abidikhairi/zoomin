<?php

namespace App\Models\Citizen;

use App\Models\Magistrate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $fillable = ['report_file'];

    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }

    public function magistrate()
    {
        return $this->belongsTo(Magistrate::class);
    }
}
