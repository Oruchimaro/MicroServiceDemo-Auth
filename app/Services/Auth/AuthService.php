<?php

namespace App\Services\Auth;

use App\Exceptions\LoginFailedExpetion;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login(string $mobile, string $password): array
    {
        $credentials = [
            'mobile' => $mobile,
            'password' => $password,
        ];

        if (! Auth::guard('web')->attempt($credentials)) {
            throw LoginFailedExpetion::causeOfCredentialMismatch();
        }

        $user = User::whereMobile($mobile)->first();
        $token = $this->createToeknForUser($user);

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    private function createToeknForUser(User|Authenticatable $user): string
    {
        return $user->createToken('authService')->accessToken;
    }
}
