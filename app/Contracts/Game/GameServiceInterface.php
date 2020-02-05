<?php

namespace App\Contracts\Game;

use App\Models\{Game, User};

interface GameServiceInterface
{
    public function createNewGame(SettingsInterface $settings): Game;

    public function applyUserForGame(User $user, Game $game): void;

    public function startTheGame(Game $game): void;
}
