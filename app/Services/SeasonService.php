<?php
namespace App\Services;

class SeasonService
{
    private $seasons = [
        'low' => ['start' => '01-04', 'end' => '30-06', 'multiplier' => 0.9],
        'medium' => ['start' => '01-07', 'end' => '31-08', 'multiplier' => 1.0],
        'high' => ['start' => '01-09', 'end' => '30-11', 'multiplier' => 1.2],
        'peak' => ['start' => '15-12', 'end' => '15-01', 'multiplier' => 1.5]
    ];

    public function getCurrentSeason(\DateTime $date = null): string
    {
        $date = $date ?? new \DateTime();
        $dateString = $date->format('d-m');
        
        foreach ($this->seasons as $season => $period) {
            if ($this->isDateInRange($dateString, $period['start'], $period['end'])) {
                return $season;
            }
        }
        
        return 'medium'; // Temporada por defecto
    }

    public function calculateSeasonalPrice(float $basePrice, \DateTime $date = null): float
    {
        $season = $this->getCurrentSeason($date);
        return $basePrice * $this->seasons[$season]['multiplier'];
    }

    private function isDateInRange(string $date, string $start, string $end): bool
    {
        // Para rangos que cruzan año nuevo (ej. dic-ene)
        if ($start > $end) {
            return $date >= $start || $date <= $end;
        }
        return $date >= $start && $date <= $end;
    }
}