<?php

namespace App\Services\Artefact;

use App\Contracts\Artefact\ArtefactGeneratorInterface;
use App\Contracts\Map\CoordinatesServiceInterface;
use App\Models\Artefact;
use App\Models\Map;
use Illuminate\Support;

class ArtefactGenerator implements ArtefactGeneratorInterface
{
    const MIN_ARTEFACTS = 10;
    const MAX_ARTEFACTS = 100;

    /**
     * @var CoordinatesServiceInterface
     */
    protected $coordinatesService = null;

    public function __construct(CoordinatesServiceInterface $coordinatesService)
    {
        $this->coordinatesService = $coordinatesService;
    }

    public function create(Map $map, int $type): Artefact
    {
        $artefact = new Artefact([
            'name' => Support\Str::random(8),
            'type' => $type
        ]);

        $map->game
            ->artefacts()
            ->save($artefact);

        $position = $this->coordinatesService
            ->getNonOccupiedPoint($map);

        $artefact->position()
            ->save($position);

        return $artefact;
    }

    public function createMany(Map $map, int $type, int $count = 0): array
    {
        if (0 >= $count) {
            $count = rand(
                static::MIN_ARTEFACTS,
                static::MAX_ARTEFACTS
            );
        }

        $artefacts = [];
        for ($i = 0; $i < $count; $i++) {
            $artefacts[] = $this->create($map, $type);
        }

        return $artefacts;
    }
}
