<?php
namespace Tests\Unit;

use App\Services\SeasonService;
use PHPUnit\Framework\TestCase;

class SeasonServiceTest extends TestCase
{
    private $seasonService;

    protected function setUp(): void
    {
        $this->seasonService = new SeasonService();
    }

    public function testSeasonDetection()
    {
        // Temporada baja (abril-junio)
        $date = new \DateTime('2023-05-15');
        $this->assertEquals('low', $this->seasonService->getCurrentSeason($date));
        
        // Temporada alta (sept-nov)
        $date = new \DateTime('2023-10-20');
        $this->assertEquals('high', $this->seasonService->getCurrentSeason($date));
        
        // Temporada peak (dic-ene)
        $date = new \DateTime('2023-12-20');
        $this->assertEquals('peak', $this->seasonService->getCurrentSeason($date));
    }

    public function testPriceCalculation()
    {
        $basePrice = 100.00;
        
        // Verificar cálculo para cada temporada
        $tests = [
            ['date' => '2023-05-01', 'expected' => 90.00],
            ['date' => '2023-07-15', 'expected' => 100.00],
            ['date' => '2023-10-01', 'expected' => 120.00],
            ['date' => '2023-12-25', 'expected' => 150.00]
        ];
        
        foreach ($tests as $test) {
            $date = new \DateTime($test['date']);
            $this->assertEquals(
                $test['expected'],
                $this->seasonService->calculateSeasonalPrice($basePrice, $date)
            );
        }
    }

    public function testYearCrossingSeason()
    {
        // Verificar que funciona para rangos que cruzan año nuevo
        $date = new \DateTime('2024-01-10');
        $this->assertEquals('peak', $this->seasonService->getCurrentSeason($date));
    }
}