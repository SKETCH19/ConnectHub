<?php
namespace Tests\Unit;

use App\Services\DiscountService;
use PHPUnit\Framework\TestCase;

class DiscountServiceTest extends TestCase
{
    private $discountService;

    protected function setUp(): void
    {
        $this->discountService = new DiscountService();
    }

    public function testDiscountCalculation()
    {
        // Sin descuentos
        $this->assertEquals(0, $this->discountService->calculateDiscount(1, 100));
        
        // 5% por 3 noches
        $this->assertEquals(5, $this->discountService->calculateDiscount(3, 100));
        
        // 10% por 7 noches
        $this->assertEquals(10, $this->discountService->calculateDiscount(7, 100));
        
        // 15% por ser miembro
        $this->assertEquals(15, $this->discountService->calculateDiscount(1, 100, true));
        
        // 25% máximo (10% + 15%)
        $this->assertEquals(25, $this->discountService->calculateDiscount(7, 100, true));
    }

    public function testDiscountApplication()
    {
        $total = 100.00;
        
        $this->assertEquals(
            90.00,
            $this->discountService->applyDiscount($total, 10.00)
        );
        
        $this->assertEquals(
            75.00,
            $this->discountService->applyDiscount($total, 25.00)
        );
        
        // No puede ser negativo
        $this->assertEquals(
            0.00,
            $this->discountService->applyDiscount($total, 150.00)
        );
    }

    public function testCombinedDiscounts()
    {
        $total = 200.00;
        $discount = $this->discountService->calculateDiscount(5, $total, true);
        $finalPrice = $this->discountService->applyDiscount($total, $discount);
        
        // 5% por estadía + 15% por miembro = 20%
        $this->assertEquals(160.00, $finalPrice);
    }
}