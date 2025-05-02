<?php

declare(strict_types=1);

namespace App\Weather\UI\Request;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class GetWeatherRequest
{
    public function __construct(
        #[Assert\NotBlank(message: 'Field can not be blank.')]
        public string $city = '',
    ) {
    }
}
