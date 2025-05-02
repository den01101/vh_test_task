<?php

declare(strict_types=1);

namespace App\Weather\UI\Message;

use App\Weather\Application\Message\GetWeatherQuery;
use App\Weather\UI\Request\GetWeatherRequest;

final readonly class GetWeatherHandlerQueryFactory
{
    /** NOTE: Create an application query based on the user request data. */
    public function create(GetWeatherRequest $request): GetWeatherQuery
    {
        return new GetWeatherQuery(
            $request->city,
        );
    }
}
