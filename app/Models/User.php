<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getNameAttribute()
    {
        return $this->first_name .' '. $this->last_name;
    }

    public function magistrate()
    {
        return $this->hasOne(Magistrate::class);
    }

    public function citizen()
    {
        return $this->hasOne(Citizen::class);
    }

    public function roomPresident()
    {
        return $this->hasOne(RoomPresident::class);
    }

    public function firstPresident()
    {
        return $this->hasOne(FirstPresident::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name .' '. $this->last_name;
    }

    public function getAccountAttribute()
    {
        return url('/'.$this->roles()->first()->name);
    }

    public function getRoleAttribute()
    {
        return $this->roles()->first()->name;
    }
}
