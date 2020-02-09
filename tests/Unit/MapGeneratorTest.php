<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\Game\Settings;
use App\Services\Map\MapGenerator;

class MapGeneratorTest extends TestCase
{
    public function tesMaptGenerator()
    {
        $settings = new Settings();
        $service = new MapGenerator();

        $map = $service->create($settins);

        $this->assertEquals($settings->getMapWidth(), $map->width);
        $this->assertEquals($settings->getMapHeight(), $map->height);

        $this->assertGreaterThan($map->artifacts()->count(), 0);
    }
}
