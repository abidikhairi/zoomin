<?php

namespace App\Models;

use App\Models\Administration\Room;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class RoomPresident extends Model
{
    use HasFactory, CrudTrait, Notifiable;

    public function room()
    {
        return $this->hasOne(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
