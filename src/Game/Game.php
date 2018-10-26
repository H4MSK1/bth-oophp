<?php
namespace H4MSK1\Game;

use H4MSK1\Dice\Dice;
use H4MSK1\Dice\DiceHand;
use H4MSK1\Dice\DiceGraphic;

class Game
{
    private $round = 0;
    private $gameOver = false;
    public $playerDisabled = 2;

    public $player1Hand;
    public $player1Rounds = [];
    public $player1RoundsDices = [];
    public $player1Dices = [];

    public $player2Hand;
    public $player2Rounds = [];
    public $player2RoundsDices = [];
    public $player2Dices = [];

    /**
     * Constructor to initiate the dicehands with a number of dices.
     *
     * @param int $player1Dices Number of dices to create, defaults to five.
     * @param int $player2Dices Number of dices to create, defaults to five.
     */
    public function __construct($player1Dices = 5, $player2Dices = 5, $useDiceGraphic = true)
    {
        $this->player1Hand = new DiceHand($player1Dices, $useDiceGraphic);
        $this->player2Hand = new DiceHand($player2Dices, $useDiceGraphic);
    }

    public function isGameOver()
    {
        return $this->gameOver;
    }

    public function getRound()
    {
        return $this->round;
    }

    public function getPlayerHand($player)
    {
        return $this->{"player{$player}Hand"};
    }

    public function getPlayerRounds($player)
    {
        return $this->{"player{$player}Rounds"};
    }

    public function playerRoundsDices($player)
    {
        return $this->{"player{$player}RoundsDices"};
    }

    public function getPlayerDices($player)
    {
        return $this->{"player{$player}Dices"};
    }

    public function getPlayerDicesObject($player)
    {
        $hand = $this->getPlayerHand($player);
        return $hand->getDices();
    }

    public function getPlayerSum($player)
    {
        return array_sum(array_values($this->getPlayerRounds($player)));
    }

    public function roll($player)
    {
        if (! in_array($player, [1, 2])) {
            throw new \Exception("Player ({$player}) is not a valid player. Please choose between [1, 2]");
        }

        $this->round++;

        if ($player === 1) {
            $this->player1Hand->roll();
            $dices = $this->player1Hand->values();
        } elseif ($player === 2) {
            $this->player2Hand->roll();
            $dices = $this->player2Hand->values();
        }

        $this->handleRound($player, $dices);

        if ($this->getPlayerSum(1) >= 100 || $this->getPlayerSum(2) >= 100) {
            $this->gameOver = true;
        }
    }

    private function handleRound($player, $dices)
    {
        foreach ($dices as $dice) {
            array_push($this->{"player{$player}Dices"}, $dice);
        }

        $playerVar = "player{$player}Rounds";

        if (in_array(1, $dices)) {
            $this->$playerVar[$this->round] = 0;
            $this->disableRoundForPlayer($player);
        } else {
            $this->$playerVar[$this->round] = array_sum($dices);
            $playerVar .= "Dices";
            $this->$playerVar[$this->round] = $dices;
        }
    }

    private function disableRoundForPlayer($player)
    {
        $this->playerDisabled = $player;
    }

    public function switchTurn()
    {
        if ($this->playerDisabled === 1) {
            $this->playerDisabled = 2;
        } else {
            $this->playerDisabled = 1;
        }
    }

    public function isPlayerDisabled($player)
    {
        return $this->playerDisabled === $player;
    }
}