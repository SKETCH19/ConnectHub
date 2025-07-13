<?php
use PHPUnit\Framework\TestCase;

class SeasonalPricingTest extends TestCase
{
    public function testPriceCalculation()
    {
        $room = [
            'low_season' => 100,
            'medium_season' => 150,
            'high_season' => 200
        ];

        $this->assertEquals(500, calculateTotalPrice($room, 'low', 5));
        $this->assertEquals(450, calculateTotalPrice($room, 'medium', 3));
        $this->assertEquals(800, calculateTotalPrice($room, 'high', 4));
    }
}

function calculateTotalPrice($room, $season, $nights)
{
    $price = $room[$season . '_season'];
    return $price * $nights;
}