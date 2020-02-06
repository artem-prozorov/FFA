<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    public function player()
    {
        return $this->belongsTo('App\Models\Player', 'player_id');
    }
    
    public function position()
    {
        return $this->belongsTo('App\Models\Position', 'position_id');
    }
}
