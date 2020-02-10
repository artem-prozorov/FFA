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
    }

    /**
     * @Given there is a setting to create a new game with a map 150x100
     */
    public function thereIsASettingToCreateANewGameWithAMapX()
    {
        $this->service = new GameService();

        $this->settings = new Settings(['width' => 150, 'height' => 100]);
    }

    /**
     * @When the service creates a new game
     */
    public function theServiceCreatesANewGame()
    {
        $this->game = $this->service->createNewGame($this->settings);
    }

    /**
     * @Then the game status is :arg1
     */
    public function theGameStatusIs($arg1)
    {
        Assert::assertEquals(GameStatuses::NEW_GAME, $this->game->status);
    }

    /**
     * @Then the map's width is 150
     */
    public function theMapsWidthIs($arg1)
    {
        Assert::assertEquals(150, $this->game->map->width);
    }

    /**
     * @Then thw map's height is :arg1
     */
    public function thwMapsHeightIs($arg1)
    {
        Assert::assertEquals(100, $this->game->map->height);
    }

    /**
     * @Given there is a game with a status :arg1
     */
    public function thereIsAGameWithAStatus($arg1)
    {
        $this->game = $this->service->createNewGame($this->settings);
    }

    /**
     * @Given the game has no players
     */
    public function theGameHasNoPlayers()
    {
        // Nothing to do
    }

    /**
     * @Given there is a userwho wants to apply for the game
     */
    public function thereIsAUserwhoWantsToApplyForTheGame()
    {
        $this->user = factory(User::class)->create();
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
     * @Given there is a game with status other than :arg1
     */
    public function thereIsAGameWithStatusOtherThan($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given a user
     */
    public function aUser()
    {
        throw new PendingException();
    }

    /**
     * @Then an exception is thrown
     */
    public function anExceptionIsThrown()
    {
        throw new PendingException();
    }

    /**
     * @Then the game's players number stays the same
     */
    public function theGamesPlayersNumberStaysTheSame()
    {
        throw new PendingException();
    }

    /**
     * @Given there is a game with status :arg1
     */
    public function thereIsAGameWithStatus($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given it has less then :arg1 players
     */
    public function itHasLessThenPlayers($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When I try to start the game
     */
    public function iTryToStartTheGame()
    {
        throw new PendingException();
    }

    /**
     * @Then I have an error
     */
    public function iHaveAnError()
    {
        throw new PendingException();
    }

    /**
     * @Then the game's status is still :arg1
     */
    public function theGamesStatusIsStill($arg1)
    {
        throw new PendingException();
    }
}
