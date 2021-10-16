<?php

namespace App\Models;

use App\Models\Administration\Room;
use App\Models\Citizen\Claim;
use App\Models\Citizen\Response;
use App\Models\CourtOfAudit\Comment;
use App\Models\CourtOfAudit\Report;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Magistrate extends Model
{
    use HasFactory, CrudTrait, Notifiable;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function claims()
    {
        return $this->hasMany(Claim::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
