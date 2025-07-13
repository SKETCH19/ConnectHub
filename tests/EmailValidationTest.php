<?php
use PHPUnit\Framework\TestCase;

class EmailValidationTest extends TestCase
{
    public function testValidEmail()
    {
        $this->assertTrue(validateEmail('usuario@example.com'));
        $this->assertTrue(validateEmail('nombre.apellido@dominio.co'));
    }

    public function testInvalidEmail()
    {
        $this->assertFalse(validateEmail('usuario@'));
        $this->assertFalse(validateEmail('usuario.example.com'));
        $this->assertFalse(validateEmail('@example.com'));
    }
}

function validateEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}