<?php

declare(strict_types=1);

namespace App\Weather\UI\Responder;

use App\Weather\Domain\Dto\GetWeatherDto;
use Symfony\Component\HttpFoundation\JsonResponse;

final class GetWeatherResponder
{
    /** NOTE: Return a successful result as a JSON response. */
    public static function respond(GetWeatherDto $responseDto): JsonResponse
    {
        return new JsonResponse([
            'country' => $responseDto->country,
            'city' => $responseDto->city,
            'temperature' => $responseDto->temperature,
            'condition' => $responseDto->condition,
            'humidity' => $responseDto->humidity,
            'wind_speed' => $responseDto->windSpeed,
            'last_updated' => $responseDto->lastUpdated,
        ]);
    }
}
