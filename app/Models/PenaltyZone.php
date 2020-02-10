<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasManyPositions;

class PenaltyZone extends Model
{
    use HasManyPositions;

    public function map()
    {
    	return $this->belongsTo(Map::class, 'map_id');
    }
}
