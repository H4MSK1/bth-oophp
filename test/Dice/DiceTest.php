<?php
namespace H4MSK1\Dice;

use PHPUnit\Framework\TestCase;

class DiceTest extends TestCase
{
    public function testCreateObject()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\H4MSK1\Dice\Dice", $dice);
    }

    public function testRoll()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\H4MSK1\Dice\Dice", $dice);

        $this->assertCount(0, $dice->results());
        $dice->roll();
        $this->assertCount(1, $dice->results());

        $lastRoll = $dice->getLastRoll();
        $this->assertTrue($lastRoll >= 1 && $lastRoll <= 6);
    }

    public function testSides()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\H4MSK1\Dice\Dice", $dice);

        $this->assertEquals(6, $dice->getSides());
    }
}
