<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artefact extends Model
{
    public function game()
    {
        return $this->belongsTo('App\Models\Game', 'game_id');
    }

    public function player()
    {
        return $this->belongsTo('App\Models\Player', 'player_id');
    }
}
