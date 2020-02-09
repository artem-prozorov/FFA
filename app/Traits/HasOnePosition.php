<?php

namespace App\Traits;

use App\Models\Position;

trait HasOnePosition
{
    public function position()
    {
        return $this->morphOne(Position::class, 'entity');
    }
}
