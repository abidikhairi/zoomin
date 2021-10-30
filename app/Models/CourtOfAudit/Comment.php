<?php

namespace App\Models\CourtOfAudit;

use App\Models\Magistrate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content'
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function magistrate()
    {
        return $this->belongsTo(Magistrate::class);
    }
}
