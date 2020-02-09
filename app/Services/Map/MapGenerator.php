<?php

namespace App\Services\Map;

use App\Contracts\Game\SettingsInterface;
use App\Contracts\Map\CoordinatesServiceInterface;
use App\Contracts\Map\MapGeneratorInterface;
use App\Models\Artefact;
use App\Models\Game;
use App\Models\Map;
use Illuminate\Support;

class MapGenerator implements MapGeneratorInterface
{
    /**
     * @var CoordinatesServiceInterface
     */
    protected $coordinatesService = null;

    public function __construct(CoordinatesServiceInterface $coordinatesService)
    {
        $this->coordinatesService = $coordinatesService;
    }

    public function create(SettingsInterface $settings, Game $game): Map
    {
        $map = new Map();

        $map->game_id = $game->id;
        $map->width = $settings->getMapWidth();
        $map->height = $settings->getMapHeight();

        $map->save();

        for ($i = 0; $i < rand(10, 100); $i++) {
            $artefact = new Artefact();

            $artefact->game_id = $game->id;
            $artefact->name = Support\Str::random(8);
            $artefact->type = 1;

            $artefact->save();

            $position = $this->coordinatesService
                ->getNonOccupiedPoint($map);

            $artefact->position()
                ->save($position);
        }

        return $map;
    }
}
