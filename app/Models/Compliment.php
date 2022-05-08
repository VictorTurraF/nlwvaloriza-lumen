<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compliment extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'sender_user_id',
        'receiver_user_id',
    ];

    protected $casts = [
        'sender_user_id' => 'integer',
        'receiver_user_id' => 'integer',
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
