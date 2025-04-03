<?php

use App\Http\Controllers\TelegramWebhookController;
use Illuminate\Support\Facades\Route;

Route::post('/telegram/webhook', [TelegramWebhookController::class, 'handle']);
Route::get('/telegram/set-webhook', [TelegramWebhookController::class, 'setWebhook']);
Route::get('/telegram/webhook-info', [TelegramWebhookController::class, 'getWebhookInfo']);
