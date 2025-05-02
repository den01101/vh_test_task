<?php

declare(strict_types=1);

namespace App\Weather\Infrastructure\Gateway;

use App\Weather\Domain\Gateway\Request\GatewayRequest;
use App\Weather\Domain\Gateway\Response\GatewayResponse;
use App\Weather\Infrastructure\Gateway\Exception\GatewayErrorException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Throwable;

final readonly class Gateway implements GatewayInterface
{
    public function __construct(
        private HttpClientInterface $client,
    ) {
    }

    public function request(GatewayRequest $request): GatewayResponse
    {
        try {
            // NOTE: Get the API response and check the response status
            $response = $this->client->request($request->method, $request->uri, $request->options);

            return Response::HTTP_OK === $response->getStatusCode()
                ? new GatewayResponse($response->getContent())
                : throw GatewayErrorException::create('Unsupported city.', $response->getStatusCode());
        } catch (Throwable $exception) {
            throw GatewayErrorException::create($exception->getMessage(), $exception->getCode());
        }
    }
}
