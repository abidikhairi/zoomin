<?php

namespace App\Models;

use App\Models\Administration\Room;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GovernmentCommissioner extends Model
{
    use HasFactory;
    use CrudTrait;

    protected $table = 'government_commissioners';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->hasOne(Room::class);
    }
}
