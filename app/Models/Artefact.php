<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasOnePosition;

class Artefact extends Model
{
    use HasOnePosition;

    protected $fillable = [
        'name',
        'type',
    ];

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }

    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }
}
