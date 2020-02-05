<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\Assert;
use App\Services\Game\{GameService, InvalidGameActionException, Settings};
use App\Models\{Game, User};
use App\Dictionaries\GameStatuses;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * @var		GameService	$service
     */
    protected $service;

    /**
     * @var		Game	$game
     */
    protected $game;

    /**
     * @var		User	$user
     */
    protected $user;

    /**
     * @var		Settings	$settings
     */
    protected $settings;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->settings = new Settings();
    }

    /**
     * @Given there is a service that creates games
     */
    public function thereIsAServiceThatCreatesGames()
    {
        $this->service = new GameService();
    }

    /**
     * @When the service creates a game
     */
    public function theServiceCreatesAGame()
    {
        $this->game = $this->service->createNewGame($this->settings);
    }

    /**
     * @Then the game status is :arg1
     */
    public function theGameStatusIs($status)
    {
        $status = $this->game->status;

        Assert::assertEquals(GameStatuses::NEW_GAME, $status);
    }

    /**
     * @Given there is a game with a status :status
     */
    public function thereIsAGameWithAStatus($status)
    {
        $this->game = factory(Game::class, ['status' => GameStatuses::NEW_GAME])->make();
    }

    /**
     * @Given the game has no players
     */
    public function theGameHasNoPlayers()
    {
        Assert::assertEquals(0, $this->game->players()->count());
    }

    /**
     * @Given a user
     */
    public function aUser()
    {
        $this->user = factory(User::class)->make();
    }

    /**
     * @When the user applies for the game
     */
    public function theUserAppliesForTheGame()
    {
        $this->service->applyUserForGame($this->user, $this->game);
    }

    /**
     * @Then the game has :arg1 player
     */
    public function theGameHasPlayer($arg1)
    {
        Assert::assertEquals(1, $this->game->players()->count());
    }

    /**
     * @Given there is a game with status other than :status
     */
    public function thereIsAGameWithStatusOtherThan($status)
    {
        $status = GameStatuses::COMPLETED_GAME;

        $this->game = factory(Game::class, ['status' => $status])->make();
    }

    /**
     * @Then the user receives an error
     */
    public function theUserReceivesAnError()
    {
        try {
            $this->service->applyUserForGame($this->user, $this->game);

            throw new \Exception('User has successfully aplied for the game but an exception has been expected');
        } catch (InvalidGameActionException $e) {
            Assert::assertTrue(true);
        }
    }

    /**
     * @Then the game's players number stays the same
     */
    public function theGamesPlayersNumberStaysTheSame()
    {
        Assert::assertEquals(0, $this->game->players()->count());
    }

    /**
     * @Given there is a game with status :arg1
     */
    public function thereIsAGameWithStatus($status)
    {
        $status = GameStatuses::NEW_GAME;

        $this->game = factory(Game::class, ['status' => $status])->make();
    }

    /**
     * @Given it has less then :playersCount players
     */
    public function itHasLessThenPlayers($playersCount)
    {
        $user = factory(User::class)->make();

        $this->service->applyUserForGame($user, $this->game);
    }

    /**
     * @When I try to start the game
     */
    public function iTryToStartTheGame()
    {
        
    }

    /**
     * @Then I have an error
     */
    public function iHaveAnError()
    {
        try {
            $this->service->startTheGame($this->game);

            throw new \Exception('The game has successfully been started but it must have thrown an exception');
        } catch (InvalidGameActionException $e) {
            Assert::assertEquals(GameStatuses::NEW_GAME, $this->game->status);
        }
    }

    /**
     * @Then the game's status is still :status
     */
    public function theGamesStatusIsStill($status)
    {
        $status = GameStatuses::NEW_GAME;

        Assert::assertEquals($status, $this->game->status);
    }
}
