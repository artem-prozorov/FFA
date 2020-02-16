<?php

namespace App\Services\Game;

use App\Contracts\Game\GameServiceInterface;
use App\Contracts\Game\SettingsInterface;
use App\Contracts\Map\MapGeneratorInterface;
use App\Dictionaries\GameStatuses;
use App\Models\Game;
use App\Models\Player;
use App\Models\User;

class GameService implements GameServiceInterface
{
    const MAX_PLAYERS = 8;

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
        if (GameStatuses::NEW_GAME !== $game->status) {
            throw new \InvalidArgumentException(
                'Game status must be "'.GameStatuses::NEW_GAME.'" (NEW_GAME)'
            );
        }

        if (static::MAX_PLAYERS < $game->players()->count()) {
            throw new \InvalidArgumentException(
                'Game players must be less than or equal "'.static::MAX_PLAYERS
            );
        }

        $alreadyInGame = $game->players()
            ->where('players.user_id', $user->id)
            ->exists();

        if ($alreadyInGame) {
            throw new \InvalidArgumentException(
                "User already in game"
            );
        }

        $player = new Player([
            'user_id' => $user->id,
            'status' => 1,
        ]);

        $game->players()->save(
            $player
        );
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
