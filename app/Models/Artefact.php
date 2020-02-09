<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artefact extends Model
{
    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }

    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }
}
