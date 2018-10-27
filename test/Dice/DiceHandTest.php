<?php
namespace H4MSK1\Dice;

use PHPUnit\Framework\TestCase;

class DiceHandTest extends TestCase
{
    public function testCreateObject()
    {
        $hand = new DiceHand(5);
        $this->assertInstanceOf("\H4MSK1\Dice\DiceHand", $hand);

        $this->assertCount(5, $hand->getDices());
    }
}
