<?php

namespace App\Contracts\Artefact;

use App\Models\Artefact;
use App\Models\Map;

interface ArtefactGeneratorInterface
{
    /**
     * @param  Map $map
     * @param  int $type
     *
     * @return Artefact
     */
    public function create(Map $map, int $type): Artefact;

    /**
     * @param  Map $map
     * @param  int $type
     * @param  int|integer $count
     *
     * @return Artefact[]
     */
    public function createMany(Map $map, int $type, int $count = 0): array;
}
