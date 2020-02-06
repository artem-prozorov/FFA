<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    public function game()
    {
        return $this->belongsTo('App\Models\Game', 'game_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function position()
    {
        return $this->belongsTo('App\Models\Position', 'position_id');
    }

    public function artefacts()
    {
        return $this->hasMany('App\Models\Artefact', 'player_id', 'id');
    }

    public function moves()
    {
        return $this->hasMany('App\Models\Move', 'current_user_id', 'id');
    }

    public function blocks()
    {
        return $this->hasMany('App\Models\Block', 'player_id', 'id');
    }
}
