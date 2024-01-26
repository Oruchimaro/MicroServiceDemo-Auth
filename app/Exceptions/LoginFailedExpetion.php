<?php

namespace App\Exceptions;

use App\Traits\RespondApi;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LoginFailedExpetion extends Exception
{
    use RespondApi;

    public static function causeOfCredentialMismatch(): self
    {
        return new self(trans('messages.credential_mismatch'), Response::HTTP_NOT_FOUND);
    }

    public function render(Request $request): JsonResponse
    {
        return $this
            ->responseError(
                empty($this->getMessage()) ? trans('messages.forbidden') : $this->getMessage(),
                $this->getCode() === 0 ? Response::HTTP_FORBIDDEN : $this->getCode()
            );
    }
}
