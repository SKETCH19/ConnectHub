<?php
use PHPUnit\Framework\TestCase;

class RegistrationTest extends TestCase {
    public function testValidRegistrationData() {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'password' => 'SecurePass123!',
            'confirm' => 'SecurePass123!'
        ];
        
        $this->assertTrue(validateRegistration($data));
    }
    
    public function testInvalidEmail() {
        $data = [
            'name' => 'John Doe',
            'email' => 'invalid-email',
            'phone' => '1234567890',
            'password' => 'SecurePass123!',
            'confirm' => 'SecurePass123!'
        ];
        
        $this->assertFalse(validateRegistration($data));
    }
}

function validateRegistration($data) {
    // Simulación de la función real
    return filter_var($data['email'], FILTER_VALIDATE_EMAIL) 
           && $data['password'] === $data['confirm']
           && strlen($data['password']) >= 8;
}