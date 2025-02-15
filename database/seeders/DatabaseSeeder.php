<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        collect([
            [
                'email' => 'admin@admin.com',
                'name' => 'test',
                'is_admin' => true,
            ],
            [
                'email' => 'test@test.com',
                'name' => 'test',
                'is_admin' => false,
            ],
        ])->each(function ($userData): void {
            User::factory()->create($userData);
        });

        $this->call([QuizSeeder::class]);
    }
}
