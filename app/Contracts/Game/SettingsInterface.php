<?php

namespace App\Contracts\Game;

interface SettingsInterface
{
    /**
     * Returns the map width
     *
     * @access	public
     * @return	void
     */
    public function getMapWidth(): int;

    /**
     * Returns the map height
     *
     * @access	public
     * @return	void
     */
    public function getMapHeight(): int;

    /**
     * Returns the map dificulty in percentage (1-100)
     *
     * @access	public
     * @return	void
     */
    public function getDificultyPercentage(): int;
}
