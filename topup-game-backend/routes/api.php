<?php

use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\TransactionController;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/games', [GameController::class, 'index']);
Route::get('/games/{slug}', [GameController::class, 'show']);
Route::post('/transaction', [TransactionController::class, 'store']);
Route::get('/transaction/{invoice_code}', [TransactionController::class, 'checkStatus']);

// List Payment Methods for Frontend
Route::get('/payment-methods', function () {
    return response()->json(['data' => PaymentMethod::where('is_active', true)->get()]);
});

// Payment Callback (Simulasi)
Route::post('/payment/callback', [TransactionController::class, 'callback']);
