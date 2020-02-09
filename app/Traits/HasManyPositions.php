<?php

namespace App\Traits;

use App\Traits\Position;

trait HasManyPositions
{
    public function positions()
    {
        return $this->morphMany(Position::class, 'entity');
    }
    
}
