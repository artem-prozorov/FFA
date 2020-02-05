<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use App\Services\Game\GameStarter;
use App\Models\{
    User,
    Game
};

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    protected $user;

    protected $game;

    protected $gameService;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->user = factory(User::class);
        $this->game = factory(Game::class);
        $this->gameService = new GameStarter();
    }

    /**
     * @Given there is a :user who can create a :game
     */
    public function thereIsAWhoCanCreateA($user, $game)
    {
        throw new PendingException();
    }

    /**
     * @When user creates a new game
     */
    public function userCreatesANewGame()
    {
        throw new PendingException();
    }

    /**
     * @Then I should have a new game
     */
    public function iShouldHaveANewGame()
    {
        throw new PendingException();
    }

    /**
     * @Then the game status is :arg1
     */
    public function theGameStatusIs($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given there is a game with a status :arg1
     */
    public function thereIsAGameWithAStatus($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given the game has no players
     */
    public function theGameHasNoPlayers()
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
     * @When the user applies for the game
     */
    public function theUserAppliesForTheGame()
    {
        throw new PendingException();
    }

    /**
     * @Then the game has :arg1 player
     */
    public function theGameHasPlayer($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given there is a game with status other than :arg1
     */
    public function thereIsAGameWithStatusOtherThan($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then the user receives an error
     */
    public function theUserReceivesAnError()
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
