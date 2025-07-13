<?php
use PHPUnit\Framework\TestCase;

class PhoneValidationTest extends TestCase
{
    public function testPhoneValidation()
    {
        $this->assertTrue(validatePhone('1234567890'));
        $this->assertTrue(validatePhone('+521234567890'));
        $this->assertTrue(validatePhone('123-456-7890'));
        
        $this->assertFalse(validatePhone('123'));
        $this->assertFalse(validatePhone('abcdefghij'));
    }
}

function validatePhone($phone)
{
    // Eliminar caracteres no numéricos
    $cleaned = preg_replace('/[^0-9+]/', '', $phone);
    return strlen($cleaned) >= 10;
}