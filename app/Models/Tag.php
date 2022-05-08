<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'color'
    ];

    protected $appends = [
        'hashtag'
    ];

    public function getHashtagAttribute () {
        return "#".$this->name;
    }
}
