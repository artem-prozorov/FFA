<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Move extends Model
{
    public function game()
    {
        return $this->belongsTo('App\Models\Game', 'game_id');
    }

    public function player()
    {
        return $this->belongsTo('App\Models\Player', 'current_user_id');
    }
}
