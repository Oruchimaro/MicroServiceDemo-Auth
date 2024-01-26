<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\WebhookController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)
    ->prefix('auth')
    ->name('auth')
    ->group(function () {
        Route::post('login', 'login')->name('login');
        Route::post('logout', 'logout')->name('logout');
    });

Route::middleware('auth')->group(function () {
    Route::prefix('webhooks')->name('webhooks')->group(function () {
        Route::get('', WebhookController::class)->name('validToken');
    });
});
