<?php

namespace App\Actions;

use App\Contracts\PositionableInterface;
use App\Contracts\AttackableInterface;
use App\Contracts\TakeableInterface;
use App\Models\Player;
use App\Exceptions\InvalidActionException;

class PositionableActionFactory
{
    public function getSuitableAction(Player $player, PositionableInterface $positionable): AbstractAction
    {
        if ($positionable instanceof AttackableInterface) {
            return App\Actions\Attack;
        }
        
        if ($positionable instanceof TakeableInterface) {
            return App\Actions\Take;
        }

        throw new InvalidActionException;
    }
}
