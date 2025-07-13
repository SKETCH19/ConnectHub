<?php
use PHPUnit\Framework\TestCase;

class RoomFilterTest extends TestCase
{
    public function testRoomFiltering()
    {
        $rooms = [
            ['type' => 'standard', 'price' => 100],
            ['type' => 'double', 'price' => 150],
            ['type' => 'suite', 'price' => 250],
            ['type' => 'standard', 'price' => 120]
        ];

        // Filtrar por tipo
        $filtered = filterRooms($rooms, 'standard', null);
        $this->assertCount(2, $filtered);
        
        // Filtrar por rango de precio
        $filtered = filterRooms($rooms, null, '100-150');
        $this->assertCount(3, $filtered);
        
        // Filtrar por ambos
        $filtered = filterRooms($rooms, 'standard', '100-120');
        $this->assertCount(2, $filtered);
    }
}

function filterRooms($rooms, $type, $priceRange)
{
    return array_filter($rooms, function($room) use ($type, $priceRange) {
        $typeMatch = !$type || $room['type'] === $type;
        
        $priceMatch = true;
        if ($priceRange) {
            list($min, $max) = explode('-', $priceRange);
            $priceMatch = $room['price'] >= $min && $room['price'] <= $max;
        }
        
        return $typeMatch && $priceMatch;
    });
}