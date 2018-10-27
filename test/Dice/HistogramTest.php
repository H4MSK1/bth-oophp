<?php

namespace H4MSK1\Dice;

use PHPUnit\Framework\TestCase;

class HistogramTest extends TestCase
{
    public function testCreateObject()
    {
        $histogram = new Histogram();
        $this->assertInstanceOf("\H4MSK1\Dice\histogram", $histogram);

        $this->assertCount(0, $histogram->getSerie());
    }
}
