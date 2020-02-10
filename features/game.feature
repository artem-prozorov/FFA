Feature: Game

    Game actions

    Scenario: Create new game
        Given there is a setting to create a new game with a map 150x100
        When the service creates a new game
        Then the game status is "New"
        And the map's width is 150
        And thw map's height is 100

    Scenario: Apply for the game
        Given there is a game with a status "New"
        And the game has no players
        And there is a userwho wants to apply for the game
        When the user applies for the game
        Then the game has 1 player

    Scenario: You cannot apply for the game if it's status is not "New"
        Given there is a game with status other than "New"
        And a user
        When the user applies for the game
        Then an exception is thrown
        And the game's players number stays the same

    Scenario: the game cannot start if it has less then 2 players
        Given there is a game with status "New"
        And it has less then 2 players
        When I try to start the game
        Then I have an error
        And the game's status is still "New"
