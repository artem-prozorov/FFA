<?php

namespace Tests\Unit\App\Services\Game;

use App\Contracts\Game\SettingsInterface;
use App\Contracts\Map\MapGeneratorInterface;
use App\Dictionaries\GameStatuses;
use App\Models\Game;
use App\Models\Map;
use App\Services\Game\GameService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GameServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var SettingsInterface
     */
    protected $settings = null;

    /**
     * @var GameService
     */
    protected $service = null;

    /**
     * Create settings before run test
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->settings = $this->createMock(
            SettingsInterface::class
        );

        $this->settings->method('getMapWidth')
            ->willReturn(rand(100, 1000));

        $this->settings->method('getMapHeight')
            ->willReturn(rand(100, 1000));

        $this->settings->method('getDificultyPercentage')
            ->willReturn(rand(1, 100));

        $mapGenerator = $this->createMock(
            MapGeneratorInterface::class
        );

        $mapGenerator->method('create')
            ->will(
                $this->returnCallback(
                    function (SettingsInterface $settings, Game $game) {
                        $map = new Map([
                            'width' => $settings->getMapWidth(),
                            'height' => $settings->getMapHeight(),
                        ]);

                        $game->map()->save($map);

                        return $map;
                    }
                )
            );

        $this->service = new GameService($mapGenerator);
    }

    /**
     * Test create new game
     */
    public function testCreateNewGame()
    {
        $game = $this->service->createNewGame(
            $this->settings
        );

        $this->assertEquals(
            GameStatuses::NEW_GAME,
            $game->status
        );

        $this->assertInstanceOf(
            Map::class,
            $game->map
        );
    }
}
