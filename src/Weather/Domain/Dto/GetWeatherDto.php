<?php

declare(strict_types=1);

namespace App\Weather\Domain\Dto;

final readonly class GetWeatherDto
{
    public function __construct(
        public string $country,
        public string $city,
        public float $temperature,
        public string $condition,
        public int $humidity,
        public float $windSpeed,
        public string $lastUpdated,
    ) {
    }
}
