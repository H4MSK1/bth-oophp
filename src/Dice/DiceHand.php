<?php
namespace H4MSK1\Dice;

/**
 * A dicehand, consisting of dices.
 */
class DiceHand
{
    /**
     * @var Dice $dices   Array consisting of dices.
     * @var int  $values  Array consisting of last roll of the dices.
     */
    private $dices = [];
    private $values = [];

    /**
     * Constructor to initiate the dicehand with a number of dices.
     *
     * @param int $dices Number of dices to create, defaults to five.
     */
    public function __construct(int $dices = 5, $useDiceGraphic = false)
    {
        $this->dices  = [];
        $this->values = [];

        for ($i = 0; $i < $dices; $i++) {
            if ($useDiceGraphic) {
                $this->dices[] = new DiceGraphic();
            } else {
                $this->dices[] = new Dice();
            }
        }
    }

    public function getDices()
    {
        return $this->dices;
    }

    /**
     * Roll all dices save their value.
     *
     * @return void.
     */
    public function roll()
    {
        $this->values = [];

        foreach ($this->dices as $dice) {
            $this->values[] = $dice->roll();
        }
    }

    /**
     * Get values of dices from last roll.
     *
     * @return array with values of the last roll.
     */
    public function values()
    {
        return array_filter($this->values);
    }

    /**
     * Get the sum of all dices.
     *
     * @return int as the sum of all dices.
     */
    public function sum()
    {
        return array_sum($this->values());
    }

    /**
     * Get the average of all dices.
     *
     * @return float as the average of all dices.
     */
    public function average()
    {
        $sum = $this->sum();
        $results = $this->values();

        return $sum / count($results);
    }
}
