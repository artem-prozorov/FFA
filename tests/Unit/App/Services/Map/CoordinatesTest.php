<?php

namespace Tests\Unit\App\Services\Game;

use Tests\TestCase;
use App\Services\Map\Coordinates;
use App\Contracts\Map\CoordinatesServiceInterface;

class CoordinatesTest extends TestCase
{
    /**
     * @var CoordinatesServiceInterface $service
     */
    protected $service;

    public function setUp(): void
    {
        $this->service = new Coordinates();
    }

    /**
     * Test that position is correctly calculated
     *
     * @dataProvider positionsProvider
     * @access	public
     * @return	void
     */
    public function testConfig(Position $positionA, Position $positionB, int $expected)
    {
        $distance = $this->service->getDistance($positionA, $positionB);

        $this->assertEquals($expected, $distance);
    }

    /**
     * Returns data set for the test
     *
     * @access	public
     * @return	array
     */
    public function configProvider(): array
    {
        return [
            [
                new Position(['x' => 10, 'y' => 10]),
                new Position(['x' => 10, 'y' => 20]),
                10,
            ],
            [
                new Position(['x' => 10, 'y' => 10]),
                new Position(['x' => 20, 'y' => 10]),
                10,
            ],
            [
                new Position(['x' => 10, 'y' => 10]),
                new Position(['x' => 20, 'y' => 20]),
                10,
            ],
        ];
    }
}
