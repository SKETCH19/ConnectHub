<?php
use PHPUnit\Framework\TestCase;

class ContactFormTest extends TestCase
{
    public function testContactFormValidation()
    {
        $validData = [
            'name' => 'Juan Pérez',
            'email' => 'juan@example.com',
            'message' => 'Este es un mensaje de prueba válido'
        ];
        
        $invalidData = [
            'name' => 'A', // Nombre muy corto
            'email' => 'no-es-un-email',
            'message' => 'corto' // Mensaje muy corto
        ];
        
        $this->assertTrue(validateContactForm($validData));
        $this->assertFalse(validateContactForm($invalidData));
    }
}

function validateContactForm($data)
{
    return strlen($data['name']) >= 3 &&
           filter_var($data['email'], FILTER_VALIDATE_EMAIL) &&
           strlen($data['message']) >= 10;
}