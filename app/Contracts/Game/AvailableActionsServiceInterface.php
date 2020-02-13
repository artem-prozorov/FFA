<?php

namespace App\Contracts\Game;

use App\Models\Player;
use App\Collections\ActionsCollection;

interface AvailableActionsServiceInterface
{
    /**
     * Returns typed collection of the actions that are available for the player
     *
     * @access public
     * @param Player $player
     * @return ActionsCollection
     */
    public function getAvailableActions(Player $player): ActionsCollection;
}
