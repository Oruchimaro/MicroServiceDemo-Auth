<?php

namespace App\Http\Controllers;

use App\Traits\RespondApi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ApiBaseController extends Controller
{
    use RespondApi;

    public function handleFailedException(\Exception|\Throwable $e, string $message = 'messages.failed')
    {
        DB::rollBack();

        Log::error($e->getMessage());

        return $this->responseError(trans($message), Response::HTTP_EXPECTATION_FAILED);
    }
}
