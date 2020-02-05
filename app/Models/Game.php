<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public function maps()
    {
    	return $this->hasMany('App\Models\Map', 'game_id', 'id');
    }
}
