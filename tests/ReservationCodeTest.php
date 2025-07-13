<?php
use PHPUnit\Framework\TestCase;

class ReservationCodeTest extends TestCase
{
    public function testReservationCodeGeneration()
    {
        $code1 = generateReservationCode('juan@example.com', '2023-06-01');
        $code2 = generateReservationCode('maria@example.com', '2023-06-01');
        $code3 = generateReservationCode('juan@example.com', '2023-06-02');
        
        $this->assertMatchesRegularExpression('/^RES-\d{3}-[A-Z0-9]{6}$/', $code1);
        $this->assertNotEquals($code1, $code2);
        $this->assertNotEquals($code1, $code3);
    }
}

function generateReservationCode($email, $date)
{
    $prefix = substr(preg_replace('/[^A-Z0-9]/', '', strtoupper($email)), 0, 3);
    $datePart = date('dmy', strtotime($date));
    $random = strtoupper(substr(md5(uniqid()), 0, 6));
    
    return 'RES-' . $prefix . '-' . $random;
}