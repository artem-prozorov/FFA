<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'x',
        'y',
    ];

    public function entity()
    {
        return $this->morphTo();
    }
}
