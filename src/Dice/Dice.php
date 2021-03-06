<?php
namespace H4MSK1\Dice;

/**
 * Dice class
 */
class Dice
{
    protected $sides;
    protected $lastRoll;
    protected $numbers = [];

    public function __construct($sides = 6)
    {
        $this->sides = $sides;
    }

    public function getSides()
    {
        return $this->sides;
    }

    public function getLastRoll()
    {
        return $this->lastRoll;
    }

    public function results()
    {
        return array_filter($this->numbers);
    }

    public function roll()
    {
        $number = rand(1, 6);
        $this->lastRoll = $number;
        $this->numbers[] = $number;

        return $number;
    }

    public function sum()
    {
        return array_sum($this->results());
    }

    public function average()
    {
        $sum = $this->sum();
        $results = $this->results();

        return $sum / count($results);
    }
}
