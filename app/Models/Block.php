<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }
    
    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }
}
