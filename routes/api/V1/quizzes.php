<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Quiz\DeleteController;
use App\Http\Controllers\V1\Quiz\IndexController;
use App\Http\Controllers\V1\Quiz\SearchController;
use App\Http\Controllers\V1\Quiz\ShowController;
use App\Http\Controllers\V1\Quiz\StoreController;
use App\Http\Controllers\V1\Quiz\UpdateController;
use Illuminate\Support\Facades\Route;

Route::prefix('quizzes')->name('quizzes:')->group(function (): void {
    Route::get('/', IndexController::class)->name('index');
    Route::get('/search', SearchController::class)->name('search');
    Route::get('{quiz}', ShowController::class)->name('show');

    Route::middleware('auth:sanctum')->group(function (): void {
        Route::post('/', StoreController::class)->name('store');
        Route::put('{quiz}', UpdateController::class)->name('update');
        Route::delete('{quiz}', DeleteController::class)->name('delete');
    });
});
