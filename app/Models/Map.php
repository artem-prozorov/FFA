<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    protected $fillable = [
        'width',
        'height',
    ];

    public function game()
    {
    	return $this->belongsTo(Game::class, 'game_id');
    }

    public function penaltyZones()
    {
    	return $this->hasMany(PenaltyZone::class, 'map_id');
    }
}
