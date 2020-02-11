<?php

namespace App\Contracts\Map;

use App\Contracts\Game\SettingsInterface;
use App\Models\{Map, Position};

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
     * @return int
     */
    public function getDistance(Position $a, Position $b): int;
}
