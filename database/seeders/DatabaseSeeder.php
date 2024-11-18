<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (App::isLocal()) {
            $this->call(
                class: [
                    QuizSeeder::class,
                ],
            );
        }
    }
}
