<?php
namespace H4MSK1\Dice;

use PHPUnit\Framework\TestCase;

class DiceGraphicTest extends TestCase
{
    public function testCreateObject()
    {
        $dice = new DiceGraphic();
        $this->assertInstanceOf("\H4MSK1\Dice\DiceGraphic", $dice);
    }

    public function testSides()
    {
        $dice = new DiceGraphic();
        $this->assertInstanceOf("\H4MSK1\Dice\DiceGraphic", $dice);

        $this->assertEquals(6, $dice::SIDES);
    }

    public function testGraphic()
    {
        $dice = new DiceGraphic();
        $this->assertInstanceOf("\H4MSK1\Dice\DiceGraphic", $dice);

        $this->assertStringStartsWith("dice-", $dice->graphic());
    }
}
