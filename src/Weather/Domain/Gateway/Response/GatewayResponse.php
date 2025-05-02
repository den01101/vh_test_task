<?php

declare(strict_types=1);

namespace App\Weather\Domain\Gateway\Response;

final readonly class GatewayResponse
{
    public function __construct(
        public string $content,
    ) {
    }
}
