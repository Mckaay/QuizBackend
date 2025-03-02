<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::prefix('v1/')->group(
    base_path(
        path: 'routes/api/V1/quizzes.php',
    ),
);
