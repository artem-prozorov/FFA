<?php

namespace App\Contracts\Artefact;

use App\Models\Artefact;
use App\Models\Map;

interface ArtefactGeneratorInterface
{
    /**
     * Create a new artefact & bind to map
     *
     * @param  Map $map
     * @param  int $type
     *
     * @return Artefact
     */
    public function create(Map $map, int $type): Artefact;

    /**
     * Create artefacts & bind to map
     *
     * @param  Map         $map
     * @param  int         $type
     * @param  int|integer $count
     *
     * @return Artefact[]
     */
    public function createMany(Map $map, int $type, int $count = 0): array;
}
