<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    public function entity() 
    {
        return $this->morphTo();
    }

    public function players()
    {
        return $this->hasMany('App\Models\Player', 'position_id', 'id');
    }

    public function blocks()
    {
        return $this->hasMany('App\Models\Block', 'position_id', 'id');
    }
}
