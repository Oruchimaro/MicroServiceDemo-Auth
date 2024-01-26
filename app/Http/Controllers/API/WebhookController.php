<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiBaseController;
use App\Http\Resources\Api\UserResource;
use Illuminate\Http\Request;

class WebhookController extends ApiBaseController
{
    public function __invoke(Request $request)
    {
        return $this->response(
            UserResource::make($request->user()),
            200
        );

    }
}
