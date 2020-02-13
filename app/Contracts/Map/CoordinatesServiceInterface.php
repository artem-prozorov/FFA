<?php

namespace App\Contracts\Map;

use App\Contracts\Game\SettingsInterface;
use App\Models\{Map, Player, Position};
use App\Collections\PositionableCollection;

interface CoordinatesServiceInterface
{
    /**
     * Returns a non-occupied point on the map
     *
     * @access	public
     * @param	Map	$map
     * @return	Position
     */
    public function getNonOccupiedPoint(Map $map): Position;

    /**
     * Returns a distance from point A to point B
     *
     * @access	public
     * @param Position $a
     * @param Position $b
     * @return float
     */
    public function getDistance(Position $a, Position $b): float;

    /**
     * Returns a collection of Positionable objects that are close to the player
     *
     * @access	public
     * @param Player $player
     * @param Map $map
     * @return	PositionableCollection
     */
    public function getPositionablesNearby(Player $player, Map $map): PositionableCollection;
}
