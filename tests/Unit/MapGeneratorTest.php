<?php

namespace Tests\Unit;

use App\Contracts\Game\SettingsInterface;
use App\Contracts\Map\CoordinatesServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Game;
use App\Models\Map;
use App\Models\Position;
use App\Services\Map\MapGenerator;
use Tests\TestCase;

class MapGeneratorTest extends TestCase
{
    use RefreshDatabase;

    public function testMapGenerator()
    {
        $settings = new class () implements SettingsInterface {
            protected $mapWidth = 0;
            protected $mapHeight = 0;
            protected $dificultyPercentage = 0;

            public function _construct()
            {
                $this->mapWidth = rand(100, 1000);
                $this->mapHeight = rand(100, 1000);
                $this->dificultyPercentage = rand(1, 100);
            }

            public function getMapWidth(): int
            {
                return $this->mapWidth;
            }

            public function getMapHeight(): int
            {
                return $this->mapHeight;
            }

            public function getDificultyPercentage(): int
            {
                return $this->dificultyPercentage;
            }
        };

        $coordinatesService = new class () implements CoordinatesServiceInterface {
            public function getNonOccupiedPoint(Map $map): Position
            {
                return factory(Position::class)->make();
            }
        };

        $service = new MapGenerator($coordinatesService);

        $game = factory(Game::class)->make();
        $game->save();

        $map = $service->create($settings, $game);

        $this->assertEquals($settings->getMapWidth(), $map->width);
        $this->assertEquals($settings->getMapHeight(), $map->height);

        $this->assertGreaterThan(0, $map->game->artefacts()->count());
    }
}
