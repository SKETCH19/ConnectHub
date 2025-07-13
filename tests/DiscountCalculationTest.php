<?php
use PHPUnit\Framework\TestCase;

class DiscountCalculationTest extends TestCase
{
    public function testDiscountCalculations()
    {
        $this->assertEquals(90, applyDiscount(100, 10)); // 10% descuento
        $this->assertEquals(75, applyDiscount(100, 25)); // 25% descuento
        $this->assertEquals(100, applyDiscount(100, 0)); // Sin descuento
        $this->assertEquals(50, applyDiscount(100, 50)); // 50% descuento
    }

    public function testInvalidDiscounts()
    {
        $this->expectException(InvalidArgumentException::class);
        applyDiscount(100, -10); // Descuento negativo
        
        $this->expectException(InvalidArgumentException::class);
        applyDiscount(100, 110); // Descuento > 100%
    }
}

function applyDiscount($price, $discountPercent)
{
    if ($discountPercent < 0 || $discountPercent > 100) {
        throw new InvalidArgumentException("El descuento debe estar entre 0 y 100");
    }
    
    return $price * (100 - $discountPercent) / 100;
}