<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
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

    public function rooms()
    {
        return $this->hasMany(Room::class, 'creator_id');
    }

    public function ownPrivetRooms()
    {
        return $this->hasMany(Room::class, 'creator_id')->where('is_privet', true);
    }

    public function allowedPrivetRooms()
    {
        return $this->hasMany(Room::class, 'to_user_id')->where('is_privet', true);
    }



    public function privetRoom(User   $user)
    {
        $ownPrivetRoom = $this->ownPrivetRooms()->where('to_user_id', $user->id)->first();
        if ($ownPrivetRoom) {
            return $ownPrivetRoom;
        }
        $allowedRoom = $this->allowedRooms()->where('creator_id', $user->id)->first();
        if ($allowedRoom) {
            return $allowedRoom;
        }

        $room = $this->rooms()->create([
            'to_user_id' => $user->id,
            'title' => 'privet  room'
        ]);;

        return $room;
    }
}
