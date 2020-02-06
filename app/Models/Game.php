<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public function maps()
    {
        return $this->hasMany('App\Models\Map', 'game_id', 'id');
    }

    public function players()
    {
        return $this->hasMany('App\Models\Player', 'game_id', 'id');
    }

    public function artefacts()
    {
        return $this->hasMany('App\Models\Artefact', 'game_id', 'id');
    }
}
