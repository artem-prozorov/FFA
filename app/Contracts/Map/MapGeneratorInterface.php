<?php

namespace App\Contracts\Map;

use App\Contracts\Game\SettingsInterface;
use App\Models\{Game, Map};

interface MapGeneratorInterface
{
    /**
     * Creates a new map with artifacts
     *
     * @access	public
     * @param	SettingsInterface	$settings	
     * @param	Game             	$game    	
     * @return	Map
     */
    public function create(SettingsInterface $settings, Game $game): Map;
}
