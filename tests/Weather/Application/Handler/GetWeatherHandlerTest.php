<?php

declare(strict_types=1);

namespace App\Tests\Weather\Application\Handler;

use App\Tests\Traits\WithFakerTrait;
use App\Weather\Application\Exception\InvalidResponseException;
use App\Weather\Application\Handler\GetWeatherHandler;
use App\Weather\Application\Message\GetWeatherQuery;
use App\Weather\Domain\Dto\GetWeatherDto;
use App\Weather\Domain\Gateway\Request\Factory\GatewayRequestFactory;
use App\Weather\Domain\Gateway\Response\GatewayResponse;
use App\Weather\Infrastructure\Gateway\GatewayInterface;
use Generator;
use JsonException;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

final class GetWeatherHandlerTest extends TestCase
{
    use WithFakerTrait;

    private GatewayInterface $gateway;
    private GetWeatherHandler $handler;

    protected function setUp(): void
    {
        $this->handler = new GetWeatherHandler(
            $this->gateway = $this->createMock(GatewayInterface::class),
            new GatewayRequestFactory(),
            $this->createMock(LoggerInterface::class),
        );
    }

    /**
     * @dataProvider gatewayResponse
     *
     * @throws JsonException
     */
    public function test_handle(bool $successResponse, array $responseData): void
    {
        $this->gateway->method('request')->willReturn(new GatewayResponse(json_encode($responseData, JSON_THROW_ON_ERROR)));

        match ($successResponse) {
            true => $this->success(),
            false => $this->failed(),
        };
    }

    public function test_invalid_response(): void
    {
        $this->expectException(InvalidResponseException::class);

        $this->gateway->method('request')->willReturn(new GatewayResponse($this->faker()->randomHtml()));

        $this->handler->handle($this->query());
    }

    private function success(): void
    {
        self::assertInstanceOf(GetWeatherDto::class, $this->handler->handle($this->query()));
    }

    private function failed(): void
    {
        $this->expectException(InvalidResponseException::class);

        $this->handler->handle($this->query());
    }

    public function gatewayResponse(): Generator
    {
        yield 'success result' => [
            true,
            [
                'location' => [
                    'country' => $this->faker()->country(),
                    'name' => $this->faker()->city(),
                ],
                'current' => [
                    'temp_c' => $this->faker()->randomFloat(),
                    'condition' => [
                        'text' => $this->faker()->lexify(),
                    ],
                    'humidity' => $this->faker()->randomNumber(),
                    'wind_kph' => $this->faker()->randomFloat(),
                    'last_updated' => $this->faker()->dateTime()->format('Y-m-d H:i:s'),
                ],
            ],
        ];
        yield 'error result' => [
            false,
            [
                'error' => [
                    'message' => $this->faker()->text(),
                ],
            ],
        ];
    }

    private function query(): GetWeatherQuery
    {
        return new GetWeatherQuery($this->faker()->city());
    }
}
