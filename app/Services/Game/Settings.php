<?php


namespace App\Services\Game;

use App\Contracts\Game\SettingsInterface;


class Settings implements SettingsInterface
{
    public const DEFAULT_MAX_WIDTH = 100;
    public const DEFAULT_MIN_WIDTH = 1000;
    public const DEFAULT_WIDTH = 250;
    public const DEFAULT_MIN_HEIGHT = 100;
    public const DEFAULT_MAX_HEIGHT = 1000;
    public const DEFAULT_HEIGHT = 250;
    public const DEFAULT_MIN_DIFICULTY = 1;
    public const DEFAULT_MAX_DIFICULTY = 10;
    public const DEFAULT_DIFICULTY = 5;

    protected $min_width;
    protected $max_width;
    protected $width;
    protected $min_height;
    protected $max_height;
    protected $height;
    protected $min_dificulty;
    protected $max_dificulty;
    protected $dificulty;

    public function __construct(array $settings = [])
    {
        $min_width = $settings['min_width'] ?? config('game.settings.default_min_width') ?? static::DEFAULT_MIN_WIDTH;
        $max_width = $settings['max_width'] ?? config('game.settings.default_max_width') ?? static::DEFAULT_MAX_WIDTH;
        $width = $settings['width'] ?? config('game.settings.default_width') ?? static::DEFAULT_WIDTH;

        if ($min_width > $width || $max_width < $width) {
            throw new \InvalidArgumentException();
        }

        $min_height = $settings['min_height'] ?? config('game.settings.default_min_height') ?? static::DEFAULT_MIN_HEIGHT;
        $max_height = $settings['max_height'] ?? config('game.settings.default_max_height') ?? static::DEFAULT_MAX_HEIGHT;
        $height = $settings['height'] ?? config('game.settings.default_height') ?? static::DEFAULT_HEIGHT;

        if ($min_height > $height || $max_height < $height) {
            throw new \InvalidArgumentException();
        }

        $min_dificulty = $settings['min_dificulty'] ?? config('game.settings.default_min_dificulty') ?? static::DEFAULT_MIN_DIFICULTY;
        $max_dificulty = $settings['max_dificulty'] ?? config('game.settings.default_max_dificulty') ?? static::DEFAULT_MAX_DIFICULTY;
        $dificulty = $settings['dificulty'] ?? config('game.settings.default_dificulty') ?? static::DEFAULT_DIFICULTY;

        if ($min_dificulty > $dificulty || $max_dificulty < $dificulty) {
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
        $this->dificulty;
    }
}
