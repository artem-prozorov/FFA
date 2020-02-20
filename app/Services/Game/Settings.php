<?php

namespace App\Services\Game;

use App\Contracts\Game\SettingsInterface;


class Settings implements SettingsInterface
{
    public const DEFAULT_MIN_WIDTH = 100;
    public const DEFAULT_MAX_WIDTH = 1000;
    public const DEFAULT_WIDTH = 250;
    public const DEFAULT_MIN_HEIGHT = 100;
    public const DEFAULT_MAX_HEIGHT = 1000;
    public const DEFAULT_HEIGHT = 250;
    public const DEFAULT_MIN_DIFICULTY = 1;
    public const DEFAULT_MAX_DIFICULTY = 10;
    public const DEFAULT_DIFICULTY = 5;

    protected $width;
    protected $height;
    protected $dificulty;

    public function __construct(array $settings = [])
    {
        $arrayConstants = [
            'min_width' => self::DEFAULT_MIN_WIDTH,
            'max_width' => self::DEFAULT_MAX_WIDTH,
            'width' => self::DEFAULT_WIDTH,
            'min_height' => self::DEFAULT_MIN_HEIGHT,
            'max_height' => self::DEFAULT_MAX_HEIGHT,
            'height' => self::DEFAULT_HEIGHT,
            'min_dificulty' => self::DEFAULT_MIN_DIFICULTY,
            'max_dificulty' => self::DEFAULT_MAX_DIFICULTY,
            'dificulty' => self::DEFAULT_DIFICULTY,
        ];
        $data = array_merge($arrayConstants, config('game.settings'), $settings);

        $minWidth = $data['min_width'];
        $maxWidth = $data['max_width'];
        $this->width = $data['width'];

        if (!($minWidth < $this->width && $maxWidth > $this->width)) {
            throw new \InvalidArgumentException();
        }

        $minHeight = $data['min_height'];
        $maxHeight = $data['max_height'];
        $this->height = $data['height'];

        if (!($minHeight < $this->height && $maxHeight > $this->height)) {
            throw new \InvalidArgumentException();
        }

        $minDificulty = $data['min_dificulty'];
        $maxDificulty = $data['max_dificulty'];
        $this->dificulty = $data['dificulty'];

        if (!($minDificulty < $this->dificulty && $maxDificulty > $this->dificulty)) {
            throw new \InvalidArgumentException();
        }
    }

    /**
     * @inheritDoc
     */
    public function getMapWidth(): int
    {
        return $this->width;
    }

    /**
     * @inheritDoc
     */
    public function getMapHeight(): int
    {
        return $this->height;
    }

    /**
     * @inheritDoc
     */
    public function getDificultyPercentage(): int
    {
        return $this->dificulty;
    }
}
