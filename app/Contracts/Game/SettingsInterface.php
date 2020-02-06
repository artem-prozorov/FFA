<?php

namespace App\Contracts\Game;

interface SettingInterface
{
    /**
     * Get map width
     *
     * @access	public
     * @return	int
     */
    public function getMapWidth(): int;

    /**
     * Get map height
     *
     * @access	public
     * @return	int
     */
    public function getMapHeight(): int;

    /**
     * getDificulty.
     *
     * @access	public
     * @return	int
     */
    public function getDificulty(): int;

    /**
     * Returns the validation rules array
     *
     * @access	public
     * @return	array
     */
    public function getValidationRules(): array;
}
