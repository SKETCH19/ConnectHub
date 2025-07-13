<?php
use PHPUnit\Framework\TestCase;

class PriceFormattingTest extends TestCase
{
    public function testPriceFormatting()
    {
        $this->assertEquals('$100.00', formatPrice(100));
        $this->assertEquals('$1,000.50', formatPrice(1000.5));
        $this->assertEquals('$99.99', formatPrice(99.99));
    }
}

function formatPrice($amount)
{
    return '$' . number_format($amount, 2);
}