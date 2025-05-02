<?php

declare(strict_types=1);

namespace App\Weather\Application\Exception;

use RuntimeException;

final class InvalidResponseException extends RuntimeException
{
    public static function create(): self
    {
        return new self('Invalid gateway response.');
    }

    public static function fromResponse(string $error): self
    {
        return new self($error);
    }
}
