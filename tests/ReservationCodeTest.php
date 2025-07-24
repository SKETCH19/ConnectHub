<?php
use PHPUnit\Framework\TestCase;

class ReservationCodeTest extends TestCase
{
    public function testReservationCodeGeneration()
    {
        $code1 = generateReservationCode('juan@example.com', '2023-06-01');
        $code2 = generateReservationCode('maria@example.com', '2023-06-01');
        $code3 = generateReservationCode('juan@example.com', '2023-06-02');
        
        // Verifica el formato del código
        $this->assertMatchesRegularExpression('/^RES-[A-Z]{3}-[A-Z0-9]{6}$/', $code1);
        $this->assertMatchesRegularExpression('/^RES-[A-Z]{3}-[A-Z0-9]{6}$/', $code2);
        $this->assertMatchesRegularExpression('/^RES-[A-Z]{3}-[A-Z0-9]{6}$/', $code3);
        
        // Verifica unicidad
        $this->assertNotEquals($code1, $code2);
        $this->assertNotEquals($code1, $code3);
    }
}

function generateReservationCode($email, $date)
{
    // Extrae 3 letras mayúsculas del email
    $prefix = substr(preg_replace('/[^A-Z]/', '', strtoupper($email)), 0, 3);
    $prefix = str_pad($prefix, 3, 'X'); // Asegura 3 caracteres
    
    // Genera parte aleatoria
    $random = strtoupper(bin2hex(random_bytes(3))); // 6 caracteres alfanuméricos
    
    return 'RES-' . $prefix . '-' . $random;
}