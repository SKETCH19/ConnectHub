<?php
use PHPUnit\Framework\TestCase;

class ReservationDateTest extends TestCase
{
    public function testValidReservationDates()
    {
        $this->assertTrue(validateReservationDates('2023-06-01', '2023-06-05'));
        $this->assertTrue(validateReservationDates('2023-12-24', '2023-12-26'));
    }

    public function testInvalidReservationDates()
    {
        $this->assertFalse(validateReservationDates('2023-06-05', '2023-06-01')); // Fecha salida antes que entrada
        $this->assertFalse(validateReservationDates('2023-06-01', '2023-06-01')); // Misma fecha
        $this->assertFalse(validateReservationDates('', '2023-06-05')); // Fecha entrada vacía
    }
}

function validateReservationDates($checkIn, $checkOut)
{
    if (empty($checkIn)) return false;
    
    $today = new DateTime();
    $start = new DateTime($checkIn);
    $end = new DateTime($checkOut);
    
    return $start < $end && $start >= $today;
}