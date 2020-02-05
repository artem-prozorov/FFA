<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penalty_zone extends Model
{
    public function map()
    {
    	return $this->belongsTo('App\Models\Map', 'map_id');
    }

    public function positions()
    {
        return $this->morphMany('App\Models\Position', 'entity');
    }
}
