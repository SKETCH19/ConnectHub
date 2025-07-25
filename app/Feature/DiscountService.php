<?php
namespace App\Services;

class DiscountService
{
    public function calculateDiscount(int $stayNights, float $totalAmount, bool $isMember = false): float
    {
        $discount = 0.0;
        
        // Descuento por estadía prolongada
        if ($stayNights >= 7) {
            $discount += 0.1; // 10% de descuento
        } elseif ($stayNights >= 3) {
            $discount += 0.05; // 5% de descuento
        }
        
        // Descuento para miembros
        if ($isMember) {
            $discount += 0.15; // 15% adicional
        }
        
        // Descuento máximo no puede superar 25%
        $discount = min($discount, 0.25);
        
        return $totalAmount * $discount;
    }

    public function applyDiscount(float $totalAmount, float $discount): float
    {
        return max(0, $totalAmount - $discount);
    }

}