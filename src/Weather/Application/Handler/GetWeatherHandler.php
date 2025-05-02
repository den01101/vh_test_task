<?php

declare(strict_types=1);

namespace App\Weather\Application\Handler;

use App\Weather\Application\Exception\InvalidResponseException;
use App\Weather\Application\Message\GetWeatherQuery;
use App\Weather\Domain\Dto\GetWeatherDto;
use App\Weather\Domain\Gateway\Request\Factory\GatewayRequestFactory;
use App\Weather\Infrastructure\Gateway\GatewayInterface;
use JsonException;
use Psr\Log\LoggerInterface;

final readonly class GetWeatherHandler
{
    public function __construct(
        private GatewayInterface $gateway,
        private GatewayRequestFactory $requestFactory,
        private LoggerInterface $logger,
    ) {
    }

    /** NOTE: Handle the query. */
    public function handle(GetWeatherQuery $query): GetWeatherDto
    {
        // NOTE: Get the response from the API client
        $response = $this->gateway->request(
            // NOTE: Prepare the API client request
            $this->requestFactory->create($query),
        );

        try {
            // NOTE: Try to decode the API response content (better use a serializer)
            $responseData = json_decode($response->content, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException) {
            throw InvalidResponseException::create();
        }

        if (isset($responseData['error'])) {
            // NOTE: Log and return the error from the API response
            $this->logger->error('Weather API error: ', $responseData);

            throw InvalidResponseException::fromResponse($responseData['error']['message']);
        }

        // NOTE: Log and return the data from the API response
        $this->logger->info('Weather API response: ', $responseData);

        $location = $responseData['location'];
        $current = $responseData['current'];

        return new GetWeatherDto(
            $location['country'],
            $location['name'],
            $current['temp_c'],
            $current['condition']['text'],
            $current['humidity'],
            $current['wind_kph'],
            $current['last_updated'],
        );
    }
}
