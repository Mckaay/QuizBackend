<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => 'PHP version: ' . phpversion());

require __DIR__ . '/auth.php';
