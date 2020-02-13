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

        /**
         * Fake settings class
         */
        $this->settings = new class () implements SettingsInterface {
            /**
             * @var integer
             */
            protected $mapWidth = 0;

            /**
             * @var integer
             */
            protected $mapHeight = 0;

            /**
             * @var integer
             */
            protected $dificultyPercentage = 0;

            public function _construct()
            {
                $this->mapWidth = rand(100, 1000);
                $this->mapHeight = rand(100, 1000);
                $this->dificultyPercentage = rand(1, 100);
            }

            /**
             * Return map width
             *
             * @return int
             */
            public function getMapWidth(): int
            {
                return $this->mapWidth;
            }

            /**
             * Return map height
             *
             * @return int
             */
            public function getMapHeight(): int
            {
                return $this->mapHeight;
            }

            /**
             * Return dificulty percentage
             *
             * @return int
             */
            public function getDificultyPercentage(): int
            {
                return $this->dificultyPercentage;
            }
        };

        /**
         * Fake MapGeneratorInterface
         */
        $mapGenerator = new class () implements MapGeneratorInterface {
            /**
             * Creates a new map with artifacts
             *
             * @access  public
             * @param   SettingsInterface   $settings
             * @param   Game                $game
             * @return  Map
             */
            public function create(SettingsInterface $settings, Game $game): Map
            {
                $map = new Map([
                    'width' => $settings->getMapWidth(),
                    'height' => $settings->getMapHeight(),
                ]);

                $game->map()->save($map);

                return $map;
            }
        };

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
