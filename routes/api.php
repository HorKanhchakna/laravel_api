<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\InvoiceController;

Route::prefix('v1')->group(function () {
    // Versioned RESTful endpoints
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('invoices', InvoiceController::class);
});
Route::get('/ping', fn () => response()->json(['pong' => true]));
