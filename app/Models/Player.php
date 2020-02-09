<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasOnePosition;

class Player extends Model
{
    use HasOnePosition;

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function artefacts()
    {
        return $this->hasMany(Artefact::class, 'player_id', 'id');
    }

    public function moves()
    {
        return $this->hasMany(Move::class, 'current_user_id', 'id');
    }

    public function blocks()
    {
        return $this->hasMany(Block::class, 'player_id', 'id');
    }
}
