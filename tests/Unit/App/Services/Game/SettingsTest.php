<?php

namespace Tests\Unit\App\Services\Game;

use Tests\TestCase;
use App\Services\Game\Settings;
use Config;
use InvalidArgumentException;

class SettingsTest extends TestCase
{
    protected $config = [
        [
            'min_width' => 100,
            'max_width' => 1000,
            'default_width' => 250,
            'min_height' => 100,
            'max_height' => 1000,
            'default_height' => 250,
            'min_dificulty' => 1,
            'max_dificulty' => 10,
            'default_dificulty' => 5,
        ]
    ];

    /**
     * Test that config is used correctly
     *
     * @dataProvider configProvider
     * @access	public
     * @return	void
     */
    public function testConfig(array $config, array $appConfig, array $expected)
    {
        Config::set(['game.settings' => $appConfig]);

        $settings = new Settings($config);

        $this->assertEquals($expected['width'], $settings->getMapWidth());
        $this->assertEquals($expected['height'], $settings->getMapHeight());
        $this->assertEquals($expected['dificulty'], $settings->getDificulty());
    }


    public function configProvider(): array
    {
        return [
            [
                ['width' => 111],
                $this->config,
                [
                    'width' => 111, 
                    'heigth' => $this->config['default_width'], 
                    'dificulty' => $this->config['default_dificulty'],
                ],
            ],
            [
                ['height' => 115],
                [],
                [
                    'width' => Settings::DEFAULT_WIDTH, 
                    'heigth' => 115, 
                    'dificulty' => Settings::DEFAULT_DIFICULTY,
                ],
            ],
        ];
    }

    /**
     * @dataProvider invalidConfigProvider
     */
    public function testExceptionForInvalidConfig(array $config)
    {
        $this->expectException(InvalidArgumentException::class);

        $settings = new Settings($config);
    }

    public function invalidConfigProvider(): array
    {
        return [
            [['width' => 0]], // width is less then the default value
            [['dificulty' => 101]], // Dificulty is greater then the default value
        ];
    }

    public function testValidationRules()
    {
        $settings = new Settings();

        $expected = [
            'width' => 'required|numeric|min:' . Settings::MIN_WIDTH . '|max:' . Settings::MAX_WIDTH,
            'height' => 'required|numeric|min:' . Settings::MIN_HEIGHT . '|max:' . Settings::MAX_HEIGHT,
            'dificulty' => 'required|numeric|min:' . Settings::MIN_DIFICULTY . '|max:' . Settings::MAX_DIFICULTY,
        ];

        $this->assertEquals($expected, $settings->getValidationRules());
    }
}
