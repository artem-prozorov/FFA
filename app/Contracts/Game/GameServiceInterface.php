<?php

namespace App\Contracts\Game;

use App\Models\{Game, User};

interface GameServiceInterface
{
    /**
     * Creates a new Game with the specified Settings
     *
     * @access	public
     * @param	SettingsInterface	$settings
     * @return	Game
     */
    public function createNewGame(SettingsInterface $settings): Game;

    /**
     * Checks if a user can apply for a game and registers the user
     *
     * @access	public
     * @param	User	$user
     * @param	Game	$game
     * @return	void
     */
    public function applyUserForGame(User $user, Game $game): void;

    /**
     * Starts the game
     *
     * @access	public
     * @param	Game	$game
     * @return	void
     */
    public function startTheGame(Game $game): void;
}
