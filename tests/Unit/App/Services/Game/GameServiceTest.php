<?php

namespace Tests\Unit\App\Services\Game;

use App\Contracts\Game\SettingsInterface;
use App\Contracts\Map\MapGeneratorInterface;
use App\Dictionaries\GameStatuses;
use App\Models\Game;
use App\Models\Map;
use App\Models\Player;
use App\Models\User;
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

    /**
     * Test apply user for game invalid status
     */
    public function testApplyUserForGameInvalidStatus()
    {
        $game = $this->service->createNewGame(
            $this->settings
        );

        $game->status = GameStatuses::ACTIVE;
        $game->save();

        $user = factory(User::class)->create();

        $this->expectException(\InvalidArgumentException::class);

        $this->service->applyUserForGame($user, $game);
    }

    /**
     * Test apply user for game invalid players count
     */
    public function testApplyUserForGameInvalidPlayersCount()
    {
        $game = $this->service->createNewGame(
            $this->settings
        );

        $game->players()->saveMany(
            factory(
                Player::class,
                GameService::MAX_PLAYERS + 1
            )->create()
        );

        $user = factory(User::class)->create();

        $this->expectException(\InvalidArgumentException::class);

        $this->service->applyUserForGame($user, $game);
    }

    /**
     * Test apply user for game is player already in game
     */
    public function testApplyUserForGameAlreadyInGame()
    {
        $game = $this->service->createNewGame(
            $this->settings
        );

        $user = factory(User::class)->create();

        $player = new Player([
            'user_id' => $user->id,
            'status' => 1,
        ]);

        $game->players()->save(
            $player
        );

        $this->expectException(\InvalidArgumentException::class);

        $this->service->applyUserForGame($user, $game);
    }

    /**
     * Test apply user for game
     */
    public function testApplyUserForGame()
    {
        $game = $this->service->createNewGame(
            $this->settings
        );

        $user = factory(User::class)->create();

        $this->service->applyUserForGame($user, $game);

        $this->assertTrue(
            $game->players()
                ->where('players.user_id', $user->id)
                ->exists()
        );
    }

    /**
     * Test start the game invalid status
     */
    public function testStartTheGameInvalidStatus()
    {
        $game = $this->service->createNewGame(
            $this->settings
        );

        $game->status = GameStatuses::ACTIVE;
        $game->save();

        $game->players()->saveMany(
            factory(
                Player::class,
                GameService::MIN_PLAYERS
            )->create()
        );

        $this->expectException(\InvalidArgumentException::class);

        $this->service->startTheGame($game);
    }

    /**
     * Test start the game invalid players count
     */
    public function testStartTheGameInvalidPlayersCount()
    {
        $game = $this->service->createNewGame(
            $this->settings
        );

        $this->expectException(\InvalidArgumentException::class);

        $this->service->startTheGame($game);
    }

    /**
     * Test start the game
     */
    public function testStartTheGame()
    {
        $game = $this->service->createNewGame(
            $this->settings
        );

        $game->players()->saveMany(
            factory(
                Player::class,
                GameService::MIN_PLAYERS
            )->create()
        );

        $this->expectException(\InvalidArgumentException::class);

        $this->service->startTheGame($game);

        $this->assertEquals(
            GameStatuses::ACTIVE,
            $game->status
        );
    }
}
