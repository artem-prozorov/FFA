<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasOnePosition;
use App\Contracts\AttackableInterface;

class Player extends Model implements AttackableInterface
{
    use HasOnePosition;

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'status',
    ];

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
        return $this->hasMany(Artefact::class, 'player_id');
    }

    public function move()
    {
        return $this->belongsTo(Move::class, 'current_user_id');
    }

    public function blocks()
    {
        return $this->hasMany(Block::class, 'player_id');
    }
}
