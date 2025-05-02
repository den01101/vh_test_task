<?php

declare(strict_types=1);

namespace App\Weather\Application\Message;

final readonly class GetWeatherQuery
{
    public function __construct(
        public string $city,
    ) {
    }
}
