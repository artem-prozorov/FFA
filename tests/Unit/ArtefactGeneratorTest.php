<?php

namespace Tests\Unit;

use App\Contracts\Map\CoordinatesServiceInterface;
use App\Models\Game;
use App\Models\Map;
use App\Models\Position;
use App\Services\Artefact\ArtefactGenerator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArtefactGeneratorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var ArtefactGenerator
     */
    protected $service = null;

    /**
     * @var Map
     */
    protected $map = null;

    /**
     * Create map & service before run test
     */
    protected function setUp(): void
    {
        parent::setUp();

        $coordinatesService = new class () implements CoordinatesServiceInterface {
            public function getNonOccupiedPoint(Map $map): Position
            {
                return factory(Position::class)->make();
            }
        };

        $this->service = new ArtefactGenerator($coordinatesService);

        $game = factory(Game::class)->make();
        $game->save();

        $this->map = new Map([
            'width' => 100,
            'height' => 200,
        ]);

        $game->map()->save($this->map);
    }

    /**
     * Test create one artefact
     */
    public function testCreateOne()
    {
        $artefact = $this->service->create($this->map, 1);

        $this->assertEquals($artefact->game_id, $this->map->game_id);
        $this->assertEquals($artefact->type, 1);
    }

    /**
     * Test create many artefacts with concrete artefacts count
     */
    public function testCreateMoreConcreteCount()
    {
        $artefacts = $this->service->createMany($this->map, 1, 5);

        $this->assertEquals(count($artefacts), 5);

        $artefactsCount = $this->map
            ->game
            ->artefacts()
            ->count();

        $this->assertEquals($artefactsCount, 5);
    }

    /**
     * Test create many artefacts with random artefacts count
     */
    public function testCreateMoreRandomCount()
    {
        $artefacts = $this->service->createMany($this->map, 1);

        $this->assertGreaterThanOrEqual(
            ArtefactGenerator::MIN_ARTEFACTS, 
            count($artefacts)
        );

        $this->assertGreaterThanOrEqual(
            count($artefacts), 
            ArtefactGenerator::MAX_ARTEFACTS
        );

        $artefactsCount = $this->map
            ->game
            ->artefacts()
            ->count();

        $this->assertGreaterThanOrEqual(
            ArtefactGenerator::MIN_ARTEFACTS, 
            $artefactsCount
        );

        $this->assertGreaterThanOrEqual(
            $artefactsCount, 
            ArtefactGenerator::MAX_ARTEFACTS
        );
    }
}
