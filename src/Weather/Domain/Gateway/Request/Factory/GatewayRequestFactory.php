<?php

declare(strict_types=1);

namespace App\Weather\Domain\Gateway\Request\Factory;

use App\Weather\Application\Message\GetWeatherQuery;
use App\Weather\Domain\Gateway\Request\GatewayRequest;
use Symfony\Component\HttpFoundation\Request;

final class GatewayRequestFactory
{
    /** NOTE: Create the API request data and URL. */
    public function create(GetWeatherQuery $query): GatewayRequest
    {
        return new GatewayRequest(
            sprintf('/v1/current.json?q=%s', $query->city),
            Request::METHOD_GET,
        );
    }
}
