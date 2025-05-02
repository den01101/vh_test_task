<?php

declare(strict_types=1);

namespace App\Weather\Infrastructure\Gateway;

use App\Weather\Domain\Gateway\Request\GatewayRequest;
use App\Weather\Domain\Gateway\Response\GatewayResponse;

interface GatewayInterface
{
    public function request(GatewayRequest $request): GatewayResponse;
}
