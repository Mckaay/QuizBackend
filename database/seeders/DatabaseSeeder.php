<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'email' => 'admin@admin.com',
            'name' => 'test',
            'is_admin' => true,
        ]);

        $this->call([QuizSeeder::class]);
    }
}
