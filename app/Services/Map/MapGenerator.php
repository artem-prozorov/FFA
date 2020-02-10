<?php

namespace App\Services\Map;

use App\Contracts\Game\SettingsInterface;
use App\Contracts\Artefact\ArtefactGeneratorInterface;
use App\Contracts\Map\MapGeneratorInterface;
use App\Models\Game;
use App\Models\Map;

class MapGenerator implements MapGeneratorInterface
{
    /**
     * @var ArtefactGeneratorInterface
     */
    protected $artefactGenerator = null;

    public function __construct(ArtefactGeneratorInterface $artefactGenerator)
    {
        $this->artefactGenerator = $artefactGenerator;
    }

    public function create(SettingsInterface $settings, Game $game): Map
    {
        $map = new Map([
            'width' => $settings->getMapWidth(),
            'height' => $settings->getMapHeight(),
        ]);

        $game->map()
            ->save($map);

        $this->artefactGenerator
            ->createMany($map, 1);

        return $map;
    }
}
