<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['creator_id', 'to_user_id', 'title', 'is_privet', 'type'];

    protected $appends = ['isVideo'];

    public function messages()
    {
        return $this->hasMany(Message::class, 'room_id');
    }


    /**
     * The roles that belong to the user.
     */
    public function users()  // who can access this chat room
    {
        return $this->belongsToMany(User::class, 'room_user');
    }

    public function getIsVideoAttribute()
    {
        return $this->type == 'video';
    }
}
