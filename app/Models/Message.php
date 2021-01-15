<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'room_id', 'body'];

    protected $appends = [
        'isCreator'
    ];



    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    public function getIsCreatorAttribute()
    {
        return $this->user_id == Auth::id();
    }

    public function getHasRemoverAttribute()
    {
        $has =  DB::table('user_message_delete')
            ->where(['message_id' => $this->id, 'user_id' => Auth::id()])->first();
        return $has ? true : false;
    }
}
