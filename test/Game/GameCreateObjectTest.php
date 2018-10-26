<?php

namespace H4MSK1\Game;

use Exception;
use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Game.
 */
class GameCreateObjectTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $game = new Game();
        $this->assertInstanceOf("\H4MSK1\Game\Game", $game);

        $game->roll(1);

        $res = count($game->getPlayerHand(1)->getDices());
        $exp = 5;
        $this->assertEquals($exp, $res);
    }



    /**
     * Construct object and verify that the object has the expected
     * properties. Use only first argument.
     */
    public function testCreateObjectFirstArgument()
    {
        $game = new Game(3);
        $this->assertInstanceOf("\H4MSK1\Game\Game", $game);

        $game->roll(1);

        $res = count($game->getPlayerHand(1)->getDices());
        $exp = 3;
        $this->assertEquals($exp, $res);
    }



    /**
     * Construct object and verify that the object has the expected
     * properties. Use both arguments.
     */
    public function testCreateObjectBothArguments()
    {
        $game = new Game(5, 5);
        $this->assertInstanceOf("\H4MSK1\Game\Game", $game);

        $game->roll(1);

        $res = count($game->getPlayerHand(1)->getDices());
        $exp = 5;
        $this->assertEquals($exp, $res);

        $game->roll(2);

        $res = count($game->getPlayerHand(2)->getDices());
        $exp = 5;
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and test isGameOver.
     */
    public function testIsGameOver()
    {
        $game = new Game();
        $this->assertInstanceOf("\H4MSK1\Game\Game", $game);

        $game->roll(1);

        $this->assertFalse($game->isGameOver());
    }

    /**
     * Construct object and test rolling a round for player number 3 (not existing).
     */
    public function testRollNonExistingPlayer()
    {
        $this->expectException(Exception::class);

        $game = new Game();
        $this->assertInstanceOf("\H4MSK1\Game\Game", $game);

        $game->roll(3);
    }
}
