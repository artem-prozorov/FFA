<?php

namespace App\Services\Game;

use App\Contracts\Game\GameServiceInterface;
use App\Contracts\Game\SettingsInterface;
use App\Contracts\Map\MapGeneratorInterface;
use App\Dictionaries\GameStatuses;
use App\Models\Game;
use App\Models\User;

class GameService implements GameServiceInterface
{
    const MAX_PLAYERS_COUNT = 8;

    /**
     * @var MapGeneratorInterface
     */
    protected $mapGenerator = null;

    public function __construct(MapGeneratorInterface $mapGenerator)
    {
        $this->mapGenerator = $mapGenerator;
    }

    /**
     * Creates a new Game with the specified Settings
     *
     * @access  public
     * @param   SettingsInterface   $settings
     * @return  Game
     */
    public function createNewGame(SettingsInterface $settings): Game
    {
        $game = new Game([
            'status' => GameStatuses::NEW_GAME,
        ]);

        $game->save();

        $map = $this->mapGenerator->create($settings, $game);

        return $game;
    }

    /**
     * Checks if a user can apply for a game and registers the user
     *
     * @access  public
     * @param   User    $user
     * @param   Game    $game
     * @return  void
     */
    public function applyUserForGame(User $user, Game $game): void
    {

    }

    /**
     * Starts the game
     *
     * @access  public
     * @param   Game    $game
     * @return  void
     */
    public function startTheGame(Game $game): void
    {

    }
}
