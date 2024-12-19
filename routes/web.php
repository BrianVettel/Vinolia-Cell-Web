<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\OrderController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::withoutMiddleware(VerifyCsrfToken::class)
    ->prefix('api')
    ->group(
        function () {
            Route::prefix('auth')
                ->group(function () {
                    Route::post('/login', [AuthController::class, 'login']);
                    Route::post('/register', [AuthController::class, 'register']);
                    Route::get('/logout', [AuthController::class, 'logout']);

                    Route::middleware('auth')->get('/me', [AuthController::class, 'getMe']);
                });

            Route::middleware(['auth-api', 'role:customer'])
                ->prefix('customer')
                ->group(function () {
                    Route::prefix('orders')->group(function () {
                        Route::get('/', [OrderController::class, 'getCurrentCustomerOrders']);
                        Route::post('/', [OrderController::class, 'createOrder']);
                        Route::get('/{id}', [OrderController::class, 'getCustomerOrderDetail']);
                        Route::post('/{id}/approve', [OrderController::class, 'approveOrder']);
                        Route::post('/{id}/decline', [OrderController::class, 'declineOrder']);
                    });
                });

            Route::middleware(['auth-api', 'role:admin'])
                ->prefix('admin')
                ->group(function () {
                    Route::prefix('orders')->group(function () {
                        Route::get('/', [OrderController::class, 'getAllOrders']);
                        Route::get('/{id}', [OrderController::class, 'getCustomerOrderDetail']);
                        Route::post('/{id}/process', [OrderController::class, 'proceedOrder']);
                        Route::put('/{id}/status', [OrderController::class, 'updateOrderStatus']);
                        Route::get('/customer/{id}', [OrderController::class, 'getCustomerOrders']);
                    });
                });

            Route::get('/issues', [OptionController::class, 'getIssues']);
            Route::get('/brands', [OptionController::class, 'getBrands']);
            Route::get('/status', [OptionController::class, 'getStatus']);
        }
    );


Route::fallback(function () {
    return response()->view('react-app', [], 200);
});
