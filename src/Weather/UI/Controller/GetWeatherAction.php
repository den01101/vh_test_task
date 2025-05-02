<?php

declare(strict_types=1);

namespace App\Weather\UI\Controller;

use App\Weather\Application\Handler\GetWeatherHandler;
use App\Weather\UI\Message\GetWeatherHandlerQueryFactory;
use App\Weather\UI\Request\GetWeatherRequest;
use App\Weather\UI\Responder\FailedResponder;
use App\Weather\UI\Responder\GetWeatherResponder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Routing\Attribute\Route;
use Throwable;

#[Route(
    path: '/weather/get',
    name: 'weather_get',
    methods: [Request::METHOD_GET],
)]
final readonly class GetWeatherAction
{
    public function __construct(
        private GetWeatherHandler $handler,
        private GetWeatherHandlerQueryFactory $queryFactory,
    ) {
    }

    /** NOTE: Get the user request and handle it. */
    public function __invoke(#[MapQueryString] GetWeatherRequest $request): JsonResponse
    {
        try {
            return GetWeatherResponder::respond(
                $this->handler->handle(
                    $this->queryFactory->create($request),
                ),
            );
        } catch (Throwable $exception) {
            return FailedResponder::respond($exception->getMessage());
        }
    }
}
