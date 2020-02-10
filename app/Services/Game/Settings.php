<?php


namespace App\Services\Game;
use App\Contracts\Game\SettingsInterface;


class Settings implements SettingsInterface
{
    public const MAX_WIDTH = 100;
    public const MIN_WIDTH = 1000;
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

    public function __construct(array $setings = [])
    {
        if(empty($setings['width']) || empty($setings['height']) || empty($setings['dificulty'])){
            $config = config('game.settings');
        }

        if(!empty($setings['width'])){
            $this->width = $setings['width'];
        }elseif(!empty($config['default_width'])){
            $this->width = $config['default_width'];
        }else{
            $this->width = self::DEFAULT_WIDTH;
        }

        if(!empty($setings['height'])){
            $this->height = $setings['height'];
        }elseif(!empty($config['default_height'])){
            $this->height = $config['default_height'];
        }else{
            $this->height = self::DEFAULT_HEIGHT;
        }

        if(!empty($setings['dificulty'])){
            $this->dificulty = $setings['dificulty'];
        }elseif(!empty($config['default_dificulty'])){
            $this->dificulty = $config['dificulty'];
        }else{
            $this->dificulty = self::DEFAULT_DIFICULTY;
        }
    }

    /**
     * get width parameters
     *
     * @access	public
     * @return	width
     */
    public function getMapWidth() :int
    {
        return $this->width;
    }

    /**
     * get height parameters
     *
     * @access	public
     * @return	height
     */
    public function getMapHeight() :int
    {
        return $this->height;
    }

    /**
     * get dificulty parameters
     *
     * @access	public
     * @return	dificulty
     */
    public function getDificultyPercentage() :int
    {
        $this->dificulty;
    }
}