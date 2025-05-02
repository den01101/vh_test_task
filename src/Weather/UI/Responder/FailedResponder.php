<?php

declare(strict_types=1);

namespace App\Weather\UI\Responder;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class FailedResponder
{
    /** NOTE: Return the error message if the process fails. */
    public static function respond(string $error): JsonResponse
    {
        return new JsonResponse(
            [
                'error' => $error,
            ],
            Response::HTTP_BAD_REQUEST,
        );
    }
}
