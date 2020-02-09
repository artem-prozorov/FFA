<?php

namespace App\Contracts\Map;

use App\Contracts\Game\SettingsInterface;
use App\Models\Map;

interface MapGeneratorInterface
{
    /**
     * Creates a new map with artifacts
     *
     * @access public
     * @param SettingsInterface $settings
     * @return Map
     */
    public function create(SettingsInterface $settings): Map;
}
