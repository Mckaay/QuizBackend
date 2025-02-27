<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('quizzes', function (Blueprint $table): void {
            $table->ulid('id')->primary();
            $table->string('title', 255);
            $table->integer('time');
            $table->string('description', 80);
            $table->bigInteger('timesPlayed')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
