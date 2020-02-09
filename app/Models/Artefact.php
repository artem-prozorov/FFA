<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasOnePosition;
use App\Contracts\TakeableInterface;

class Artefact extends Model implements TakeableInterface
{
    use HasOnePosition;

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }

    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }
}
