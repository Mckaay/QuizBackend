<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Quiz\DeleteController;
use App\Http\Controllers\V1\Quiz\IncrementQuizPlaysController;
use App\Http\Controllers\V1\Quiz\IndexController;
use App\Http\Controllers\V1\Quiz\ShowController;
use App\Http\Controllers\V1\Quiz\StoreController;
use App\Http\Controllers\V1\Quiz\UpdateController;
use Illuminate\Support\Facades\Route;

Route::prefix('quiz')->name('quiz:')->group(function (): void {
    Route::get('/', IndexController::class)->name('index');
    Route::get('{quiz}', ShowController::class)->name('show');
    Route::post('/', StoreController::class)->name('store');
    Route::get('/increment/{id}', IncrementQuizPlaysController::class)->name('increment');

    Route::middleware('auth:sanctum')->group(function (): void {
        Route::post('/', StoreController::class)->name('store');
        Route::put('{quiz}', UpdateController::class)->name('update');
        Route::delete('{quiz}', DeleteController::class)->name('delete');
    });
});
