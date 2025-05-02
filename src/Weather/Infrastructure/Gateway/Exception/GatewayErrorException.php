<?php

declare(strict_types=1);

namespace App\Weather\Infrastructure\Gateway\Exception;

use RuntimeException;

final class GatewayErrorException extends RuntimeException
{
    public static function create(string $message, int $code): self
    {
        return new self($message, $code);
    }
}
