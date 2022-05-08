<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compliment extends Model
{
    protected $fillable = [
        'message',
        'sender_user_id',
        'receiver_user_id',
    ];

    public function sender()
    {
        return $this->hasOne(User::class, 'sender_user_id');
    }

    public function receiver()
    {
        return $this->hasOne(User::class, 'receiver_user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
