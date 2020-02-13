<?php

namespace Tests\Unit;

use App\Contracts\Game\SettingsInterface;
use App\Contracts\Map\CoordinatesServiceInterface;
use App\Models\Game;
use App\Models\Map;
use App\Models\Position;
use App\Services\Artefact\ArtefactGenerator;
use App\Services\Map\MapGenerator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MapGeneratorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test create map with artefacts
     */
    public function testMapGenerator()
    {
        /**
         * Fake settings class
         */
        $settings = new class () implements SettingsInterface {
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
         * Fake coordinates service
         */
        $coordinatesService = new class () implements CoordinatesServiceInterface {
            /**
             * Return non occupied point by map
             *
             * @param  Map    $map
             *
             * @return position
             */
            public function getNonOccupiedPoint(Map $map): Position
            {
                return factory(Position::class)->make();
            }

            /**
             * @param  Position $a
             * @param  Position $b
             *
             * @return float
             */
            public function getDistance(Position $a, Position $b): float
            {
                return 0;
            }
        };

        // Use real generator because from create fake need copy real generator
        $artefactGenerator = new ArtefactGenerator($coordinatesService);

        $service = new MapGenerator($artefactGenerator);

        $game = factory(Game::class)->create();

        $map = $service->create($settings, $game);

        $this->assertEquals($settings->getMapWidth(), $map->width);
        $this->assertEquals($settings->getMapHeight(), $map->height);

        $this->assertGreaterThan(0, $map->game->artefacts()->count());
    }
}
