<?php

namespace App\Services\Map;

use App\Contracts\Map\CoordinatesServiceInterface;
use App\Models\Map;
use App\Models\Position;

class Coordinates implements CoordinatesServiceInterface
{
    /**
     * Returns a non-occupied point on the map
     *
     * @access  public
     * @param   Map $map
     *
     * @return  Position
     */
    public function getNonOccupiedPoint(Map $map): Position
    {
        return new Position();
    }

    /**
     * Returns a distance from point A to point B
     *
     * @access  public
     * @param Position $a
     * @param Position $b
     *
     * @return float
     */
    public function getDistance(Position $a, Position $b): float
    {
        $absDiffX = abs($b->x - $a->x);
        $absDiffY = abs($b->y - $a->y);

        return sqrt(
            $absDiffX ** 2 + $absDiffY ** 2
        );
    }
}
