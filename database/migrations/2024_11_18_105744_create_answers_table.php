<?php

declare(strict_types=1);

use App\Models\Question;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('answers', function (Blueprint $table): void {
            $table->ulid('id')->primary();
            $table->foreignIdFor(Question::class)->index()->constrained()->cascadeOnDelete();
            $table->string('content', 255);
            $table->boolean('is_correct')->default(false);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
