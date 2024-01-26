<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiBaseController;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Resources\Api\LoginResponseResource;
use App\Services\Auth\AuthService;
use Illuminate\Http\Response;

class AuthController extends ApiBaseController
{
    public function __construct(private AuthService $authService)
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(LoginRequest $request)
    {
        $res = $this->authService->login(
            $request->validated('mobile'),
            $request->validated('password')
        );

        return $this->response(
            LoginResponseResource::make($res, Response::HTTP_OK)
        );
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return $this->response(
            'messages.logged_out'
        );
    }
}
