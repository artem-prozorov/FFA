Feature: Game

    Game actions

    Scenario: Create new game
        Given there is a user who can create a game
        When user creates a new game
        Then I should have a new game
        And the game status is "New"

    Scenario: Apply for the game
        Given there is a game with a status "New"
        And the game has no players
        And a user
        When the user applies for the game
        Then the game has 1 player

    Scenario: You cannot apply for the game if it's status is not "New"
        Given there is a game with status other than "New"
        And a user
        When the user applies for the game
        Then the user receives an error
        And the game's players number stays the same

    Scenario: the game cannot start if it has less then 2 players
        Given there is a game with status "New"
        And it has less then 2 players
        When I try to start the game
        Then I have an error
        And the game's status is still "New"
