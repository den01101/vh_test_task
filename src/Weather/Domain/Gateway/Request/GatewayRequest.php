<?php

declare(strict_types=1);

namespace App\Weather\Domain\Gateway\Request;

final readonly class GatewayRequest
{
    public function __construct(
        public string $uri,
        public string $method,
        public array $options = [],
    ) {
    }
}
