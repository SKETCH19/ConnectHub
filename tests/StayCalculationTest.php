<?php
use PHPUnit\Framework\TestCase;

class StayCalculationTest extends TestCase
{
    public function testNightCalculation()
    {
        $this->assertEquals(1, calculateNights('2023-01-01', '2023-01-02'));
        $this->assertEquals(7, calculateNights('2023-01-01', '2023-01-08'));
        $this->assertEquals(30, calculateNights('2023-01-01', '2023-01-31'));
    }
}

function calculateNights($checkIn, $checkOut)
{
    $start = new DateTime($checkIn);
    $end = new DateTime($checkOut);
    return $end->diff($start)->days;
}