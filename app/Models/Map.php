<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    public function game()
    {
    	return $this->belongsTo('App\Models\Game', 'game_id');
    }

    public function penalty_zones()
    {
    	return $this->hasMany('App\Models\Penalty_zone', 'map_id', 'id');
    }
}
