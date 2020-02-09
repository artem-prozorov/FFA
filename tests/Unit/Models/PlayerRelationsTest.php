<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\{Game, Position, Player, User};
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlayerRelationsTest extends TestCase
{
    use RefreshDatabase;

    public function testPlayerRelations()
    {
        $user = factory(User::class)->create();
        $game = factory(Game::class)->create();
        $player = factory(Player::class)->create(['user_id' => $user->id, 'game_id' => $game->id]);

        $position = factory(Position::class)->make();
        $player->position()->save($position);

        $this->assertEquals($user->id, $player->user->id);
        $this->assertEquals($game->id, $player->game->id);
        $this->assertEquals($position->id, $player->position->id);
    }
}
