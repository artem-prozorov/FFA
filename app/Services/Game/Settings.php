<?php

namespace App\Services\Game;

use App\Contracts\Game\SettingsInterface;
use Illuminate\Support\Facades\Validator;


class Settings implements SettingsInterface
{
    public const MIN_WIDTH = 100;
    public const MAX_WIDTH = 1000;
    public const DEFAULT_WIDTH = 250;
    public const MIN_HEIGHT = 100;
    public const MAX_HEIGHT = 1000;
    public const DEFAULT_HEIGHT = 250;
    public const MIN_DIFICULTY = 1;
    public const MAX_DIFICULTY = 10;
    public const DEFAULT_DIFICULTY = 5;

    protected $width;
    protected $height;
    protected $dificulty;
    protected $validationRules;

    public function __construct(array $settings = [])
    {
        $defaultConfig = [
            'min_width' => self::MIN_WIDTH,
            'max_width' => self::MAX_WIDTH,
            'width' => self::DEFAULT_WIDTH,
            'min_height' => self::MIN_HEIGHT,
            'max_height' => self::MAX_HEIGHT,
            'height' => self::DEFAULT_HEIGHT,
            'min_dificulty' => self::MIN_DIFICULTY,
            'max_dificulty' => self::MAX_DIFICULTY,
            'dificulty' => self::DEFAULT_DIFICULTY,
        ];

        $appConfig = config('game.settings') ?? []; // если в конфиге приложения ничего нет, то $appConfig - это будет пустой массив
        $data = array_merge($defaultConfig, $appConfig, $settings);

        $this->width = $data['width'];
        $this->height = $data['height'];
        $this->dificulty = $data['dificulty'];

        $this->validationRules = [
            'width' => 'required|numeric|min:' . $data['min_width'] . '|max:' . $data['max_width'],
            'height' => 'required|numeric|min:' . $data['min_height'] . '|max:' . $data['max_height'],
            'dificulty' => 'required|numeric|min:' . $data['min_dificulty'] . '|max:' . $data['max_dificulty'],
        ];

        $config = [
            'height' => $this->height,
            'width' => $this->width,
            'dificulty' => $this->dificulty,
        ];

        $validator = Validator::make($config, $this->validationRules);

        if ($validator->fails()) {
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

    /**
     * Returns the validation rules
     *
     * @access    public
     * @return    array
     */
    public function getValidationRules(): array
    {
        return $this->validationRules;
    }
}
