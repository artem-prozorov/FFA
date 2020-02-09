<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public function map()
    {
        return $this->hasOne(Map::class, 'game_id');
    }

    public function players()
    {
        return $this->hasMany(Player::class, 'game_id', 'id');
    }

    public function artefacts()
    {
        return $this->hasMany(Artefact::class, 'game_id', 'id');
    }

    public function moves()
    {
        return $this->hasMany(Move::class, 'game_id', 'id');
    }
}
