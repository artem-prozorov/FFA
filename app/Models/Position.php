<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    public function entity() 
    {
        return $this->morphTo();
    }
}
